<?php

namespace App\Http\Controllers\AdminDashboard;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{




    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('read_roles');
        $roles = Role::latest()->paginate(5);
        return view('AdminDashboard.Roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create_roles');
        $roles = Role::latest()->paginate(5);
        $permissions = Permission::all();
        return view('AdminDashboard.Roles.create', compact('roles', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create_roles');
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permissions' => 'required',
        ]);

        $role = Role::create(['name' => $request->get('name')]);
        $role->syncPermissions($request->get('permissions'));

        toastr()->success(__('Role has been added successfully'));
        return redirect()->route('roles.index');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        Gate::authorize('edit_roles');
        $role = Role::findById($id);
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('name')->toArray();
        return view('AdminDashboard.Roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Role $role, Request $request)
    {
        Gate::authorize('edit_roles');
        $this->validate($request, [
            'name' => 'required|unique:roles,name,' . $role->id . 'id',
            'permissions' => 'required',
        ]);

        $role->update($request->only('name'));
        $role->syncPermissions($request->get('permissions'));

        toastr()->success(__('Role has been updated successfully'));
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('delete_roles');
        $role = Role::findById($id);
        $role->delete();
        toastr()->success(__('Role has been deleted successfully'));
        return redirect()->route('roles.index');
    }
}