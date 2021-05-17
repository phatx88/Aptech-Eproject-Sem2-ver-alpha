<?php

namespace App\Http\Controllers;

use App\Models\PermissionRole;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class Admin_PermissionRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $role_id = $request->role_id;
        // dd($role_id);
        $roles = Role::get();
        if (!empty($role_id)) {
            $permission_roles = PermissionRole::where('role_id' , $role_id)->groupBy('permission_id')->get();
        } else {
            $role_id = 1;
            $permission_roles = PermissionRole::where('role_id' , $role_id)->groupBy('permission_id')->get();
        }
        return view('admin.authorization.role_permission.list' , [
            'role_id' => $role_id,
            'roles' => $roles,
            'permission_roles' => $permission_roles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($role_id)
    {
        $permissionsIn = PermissionRole::where('role_id', $role_id)->pluck('permission_id');
        $permissions = Permission::whereNotIn('id', $permissionsIn)->get();
        // dd($permissions);
        $role = Role::where('id', $role_id)->first();
        return view('admin.authorization.role_permission.add' , [
            'role' => $role,
            'permissions' => $permissions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'role_id' => 'required',
            'permission_id' => 'required',
        ]);
        $permission_role = new PermissionRole();
        $permission_role->role_id = $request->role_id;
        $permission_role->permission_id = $request->permission_id;
        try {
            $permission_role->save();
        } catch (QueryException $e) {
            request()->session()->put('error', $e->getMessage());
            return redirect()->back();
        }
        return redirect()->route('admin.permission_role.index' , ['role_id' => $request->role_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PermissionRole  $permissionRole
     * @return \Illuminate\Http\Response
     */
    public function show(PermissionRole $permissionRole)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PermissionRole  $permissionRole
     * @return \Illuminate\Http\Response
     */
    public function edit(PermissionRole $permissionRole)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PermissionRole  $permissionRole
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PermissionRole $permissionRole)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PermissionRole  $permissionRole
     * @return \Illuminate\Http\Response
     */
    public function destroy($role_id, $permission_id)
    {
          $permission_role = PermissionRole::where('role_id' , $role_id)->where('permission_id' , $permission_id)->first();
        //   dd($permission_role);
          try {
              $permission_role->forceDelete();
              request()->session()->put('success', "Deleted role_id: {$role_id} / permission_id: {$permission_id} Successfully");
          } catch (QueryException $e) {
              if ($e->getCode() == 23000) {
                  request()->session()->put('error', $e->getMessage());
              }
          }
          return redirect()->back();
    }
}
