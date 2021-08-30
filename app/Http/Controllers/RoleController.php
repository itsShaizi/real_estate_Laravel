<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::with('permissions')->paginate(20);
        return view('backend.roles', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $selectedGroups = [];
        $unselectedGroups = Permission::get(['id','permission as name'])->toArray();

        return view('backend.role.create', ['roles' => Role::all(), 'unselectedGroups' => $unselectedGroups, 'selectedGroups' => $selectedGroups]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = Role::create($request->all());
        $role_id = $role->id;
        if(!empty($request->permissions)){
            $permissions = explode(",",$request->permissions);
            foreach ($permissions as $permission){
                if(!empty($permission)){
                    $permission_role = new PermissionRole();
                    $permission_role->permission_id = $permission;
                    $permission_role->role_id = $role_id;
                    $permission_role->save();
                }
            }
        }
        return redirect()->route('bk-roles');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $role_info = Role::with(array('permissions'=>function($query){
            $query->select('id','permission as name');
        }))->where('id',$role->id)->first();

        $selectedGroups = $role_info->permissions;

        $ids = $selectedGroups->pluck('id')->toArray();
        $selectedGroups = $selectedGroups->toArray();

        $unselectedGroups = Permission::get(['id','permission as name'])->whereNotIn('id',$ids)->toArray();
        return view('backend.role.edit', ['role' => $role, 'roles' => Role::all(), 'unselectedGroups' => $unselectedGroups, 'selectedGroups' => $selectedGroups]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {


        $role->title = $request->title;
        $role->admin = $request->admin;
        $role->update();
        PermissionRole::where('role_id',$role->id)->delete();
        if(!empty($request->permissions)){
            $permissions = explode(",",$request->permissions);
            foreach ($permissions as $permission){
                if(!empty($permission)){
                    $permission_role = new PermissionRole();
                    $permission_role->permission_id = $permission;
                    $permission_role->role_id = $role->id;
                    $permission_role->save();
                }
            }
        }
        return redirect()->route('bk-roles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('bk-roles');
    }

}
