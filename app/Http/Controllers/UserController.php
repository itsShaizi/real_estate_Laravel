<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Group;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(20);

        return view('backend.users', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::make();
        $selectedGroups = [];
        $unselectedGroups = Group::get(['id','name'])->toArray();

        return view('backend.user.create', ['user' => $user, 'roles' => Role::all(), 'companies' => Company::all(), 'unselectedGroups' => $unselectedGroups, 'selectedGroups' => $selectedGroups]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = User::make($request->except('active','is_contact','groups','password'));
        $user->password = Hash::make($request->password);
        $user->active = (!empty($request->active)) ? 1 : 0;
        $user->is_contact = (!empty($request->is_contact)) ? 1 : 0;
        $user->save();

        // Users can be related to many groups
        if(!empty($request->groups)){
            $user->groups()->sync(explode(',',$request->groups));
        }

        // Upload user Avatar
        $this->uploadUserAvatar($request, $user);

        return redirect()->route('bk-users')->with('success','User created successfully.');
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
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $selectedGroups = $user->groups->map->only(['id', 'name']);
        $unselectedGroups = Group::whereNotIn('id', $selectedGroups->pluck('id'))->get(['id','name'])->toArray();

        return view('backend.user.edit', ['user' => $user, 'roles' => Role::all(), 'companies' => Company::all(), 'unselectedGroups' => $unselectedGroups, 'selectedGroups' => $selectedGroups->toArray()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $user->fill($request->except('active','is_contact','groups','password'));
        $user->active = (!empty($request->active)) ? 1 : 0;
        $user->is_contact = (!empty($request->is_contact)) ? 1 : 0;

        // Users can be related to many groups
        if(!empty($request->groups)){
            $user->groups()->sync(explode(',',$request->groups));
        }

        // An admin can reset a user's password
        if(!empty($request->password)){
            $this->validate($request,[
                'password' => ['confirmed', Password::min(8)]
            ]);
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Upload user Avatar
        $this->uploadUserAvatar($request, $user);

        return redirect()->route('bk-users')->with('success','User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('bk-users')->with('success','User deleted successfully.');
    }


    public function search(Request $request) {
    // DB::enableQueryLog();

        $users = User::where(function ($query) use ($request) {
                        $query->where('first_name', 'LIKE', '%'.$request->s_query.'%')
                        ->orWhere('last_name', 'LIKE', '%'.$request->s_query.'%')
                        ->orWhere('email', 'LIKE', '%'.$request->s_query.'%');
                    });

        $request->flash();

        $users = $users->paginate(20);

    // $queries = DB::getQueryLog();
    // dd($queries);

        return view('backend.users', ['users' => $users]);
    }

    /**
     * Store the user avatar
     *
     * @param Request $request
     * @param User $user
     * @return void
     */
    private function uploadUserAvatar($request, $user): void
    {
        if ($request->filled('avatar')) {
            // Ensure that the Temp Image exists
            if (Storage::disk('tmp')->exists($request->avatar)) {
                // Create the new Images and Persist to Database
                (new \App\Actions\CreateImageAction)->handle(
                    $user,
                    Storage::disk('tmp')->get($request->avatar)
                );
    
                // Remove the Temp image from disk
                Storage::disk('tmp')->delete($request->avatar);
            }
        }
    }
}
