<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\Country;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\CompanyRequest;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::paginate(20);

        return view('backend.companies', ['companies' => $companies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.company.create', [
            'company' => new Company,
            'types' => Company::TYPES,
            'countries' => Country::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        $company = Company::firstOrCreate($request->safe()->except(['logo']));

        // Upload Logo
        $this->uploadLogo($request, $company);

        if($company->wasRecentlyCreated){
            return redirect()->route('bk-companies')->with('success','Company created successfully.');
        } else {
            return redirect()->route('bk-companies')->with('success','That Company has already been created.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('backend.company.edit', [
            'company' => $company,
            'types' => Company::TYPES,
            'countries' => Country::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, Company $company)
    {

        $company->fill($request->safe()->except(['logo','active']));
        $company->active = $request->filled('active') ? 1 : 0;
        $company->save();

        // Upload Logo
        $this->uploadLogo($request, $company);

        return redirect()->route('bk-companies')->with('success','Company updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()->route('bk-companies')->with('success','Company '. $company->name . ' was deleted successfully.');
    }

    /**
     * Store the company's logo
     *
     * @param Request $request
     * @param Company $company
     * @return void
     */
    private function uploadLogo($request, $company): void
    {
        if ($request->filled('logo')) {
            // Ensure that the Temp Image exists
            if (Storage::disk('tmp')->exists($request->logo)) {
                // Create the new Images and Persist to Database
                (new \App\Actions\CreateImageAction)->handle(
                    $company,
                    Storage::disk('tmp')->get($request->logo)
                );

                // Remove the Temp image from disk
                Storage::disk('tmp')->delete($request->logo);
            }
        }
    }
}
