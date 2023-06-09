<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use App\Models\SoftDeletedRole;

class RoleController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:role-list|role-create|role-edit|role-delete|role-show|role-trashed|role-trashed-restore|role-trashed-delete', ['only' => ['index','store']]);
         $this->middleware('permission:role-create', ['only' => ['create','store']]);
         $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:role-delete', ['only' => ['destroy']]);
         $this->middleware('permission:role-show', ['only' => ['show']]);
         $this->middleware('permission:role-trashed', ['only' => ['trashed']]);
         $this->middleware('permission:role-trashed-restore', ['only' => ['restore']]);
         $this->middleware('permission:role-trashed-delete', ['only' => ['delete']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $roles = SoftDeletedRole::orderBy('id','DESC')->paginate(5);
        return view('backend.roles.index',compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permission = Permission::get();
        return view('backend.roles.create',compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
    
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));
    
        return redirect()->route('roles.index')
                        ->with('success','Role created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();
    
        return view('backend.roles.show',compact('role','rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::find($id);
        $permissions = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
    
        return view('backend.roles.edit', compact('role','permissions','rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);
    
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
    
        $role->syncPermissions($request->input('permission'));
    
        return redirect()->route('roles.index')
                        ->with('success','Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SoftDeletedRole $role)
    {
        $role->delete();
        return redirect()->route('roles.index')
                        ->with('success','Role deleted successfully');
    }


public function trashed()
{
    $softDeletedRoles = SoftDeletedRole::onlyTrashed()->get();
    return view('backend.roles.trashed',compact('softDeletedRoles'));
}
public function restore($id)
{
    SoftDeletedRole::onlyTrashed()->find($id)->restore();
    return redirect()->route('roles.trashed')
    ->with('success','role restored successfully.');
}
public function delete($id)
{
    SoftDeletedRole::onlyTrashed()->find($id)->forceDelete();
    return redirect()->route('roles.trashed')
    ->with('success','role permanent deleted successfully.');
}

}
