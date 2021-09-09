<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Company;
use App\Models\ListingProject;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use App\Http\Requests\Projects\UploadMediaRequest;
use App\Http\Requests\Projects\StoreProjectRequest;
use App\Http\Requests\Projects\UpdateProjectRequest;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::paginate(20);
        return view('backend.projects', ['projects' => $projects, 'companies' => Company::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.project.create', ['companies' => Company::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {   
        $project = Project::create($request->safe()->except('featured', 'status'));
        $project->featured = (!empty($request->featured)) ? 1 : 0;
        $project->status = $request->status;
        $project->save();
        return redirect()->route('bk-projects');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('backend.project.edit', ['project' => $project, 'companies' => Company::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {   
        $project->fill($request->safe()->except('featured', 'status'));
        $project->featured = (!empty($request->featured)) ? 1 : 0;
        $project->status = $request->status;
        $project->save();
        return redirect()->route('bk-projects');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('bk-projects')->with('success','Project '. $project->name . ' deleted successfully.');
    }

    public function listings(Project $project) {
        $listings = ListingProject::where('project_id', $project->id)->get('listing_id')->toArray();
        $listings = Arr::flatten($listings);
        return Listing::whereIn('id', $listings)->get()->toArray();
    }

    public function add_listing(Request $request, Project $project, Listing $listing) {
        $listing_project = new ListingProject;
        $listing_project->listing_id = $listing->id;
        $listing_project->project_id = $project->id;
        if($listing_project->save()){
            return true;
        }
        else
            return false;
    }

    public function remove_listing(Request $request, Project $project, Listing $listing) {
        //Laravel models don't support composite keys, we can only do this using DB
        if(DB::table('listing_project')->where('listing_id', $listing->id)->where('project_id', $project->id)->delete())
            return true;
        else
            return false;

    }

    public function uploadMedia(UploadMediaRequest $request, $project_id)
    {
        if($request->hasFile('media')) {
            $project = Project::findOrFail($project_id);

            (new \App\Actions\CreateImageAction)
                ->handle($project, $request->file('media'));
        }
    }
}
