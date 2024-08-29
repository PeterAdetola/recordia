<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Module;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view role', ['only' => ['ViewRoles']]);
        $this->middleware('permission:create role', ['only' => ['store']]);
        $this->middleware('permission:create permission', ['only' => ['AssignPermission']]);
        $this->middleware('permission:edit role', ['only' => ['update']]);
        $this->middleware('permission:delete role', ['only' => ['destroy']]);
    }

    /**
     * View Role.
     */
    public function ViewRoles()
    {
       
        $roles = Role::get();
        return view('admin.role_permission.role.view_roles', compact('roles'));
    }

    /**
     * Store Role.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name'
            ]
        ]);

        $roleName = strtolower($request->name);
        Role::create([
            'name' => $roleName,
            'module_id' => $request->module_id,
        ]);

        $notification = array(
            'message' => 'Role saved',
        );

        return redirect()->back()->with($notification);
        
    }  //End Method

    /**
     * Update Role.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name,'.$role->id
            ]
        ]);

        $role->update([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => 'Role updated',
        );

        return redirect()->back()->with($notification);
        
    }  //End Method

    /**
     * Delete Role.
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();

        $notification = array(
            'message' => 'Role deleted',
        );

        return redirect()->back()->with($notification);
    }  //End Method

    /**
     * Assign Permission.
     */
    public function AssignPermission($id)
    {
        $permissions = Permission::get();
        $role = Role::findOrFail($id);
        // $permissions = Permission::pluck('name')->toArray();
        $moduleIds = Permission::distinct('module_id')->pluck('module_id');
        $modules = Module::whereIn('id', $moduleIds)->get();
        $rolePermissions = DB::table('role_has_permissions')
                    ->where('role_id', $role->id)
                    // ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
                    ->pluck('permission_id', 'permission_id')
                    ->all();

        return view('admin.role_permission.permission.assign_permissions', compact('role', 'permissions', 'modules', 'rolePermissions' ));
        
    }  //End Method

    /**
     * Update Permission.
     */
    public function UpdatePermission(Request $request, $id)
    {
        $request->validate([
            'permission' => 'required'
        ]);
       
        $role = Role::findOrFail($id);
        $role->syncPermissions($request->permission);

        $notification = array(
            'message' => 'Permission Updated',
        );

        return redirect()->back()->with($notification);
    }
}
