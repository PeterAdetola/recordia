<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Models\Module;

class PermissionController extends Controller
{
    public function managePermission()
    {
       
        $modules = Module::get();
        $permissions = Permission::with('module')->get();
        return view('admin.role_permission.view_permissions', compact('permissions', 'modules'));
    }

    /**
     * Store Permission.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name'
            ]
        ]);

        Permission::create([
            'name' => $request->name,
            'module_id' => $request->module_id,
        ]);

        $notification = array(
            'message' => 'Permission saved',
        );

        return redirect()->back()->with($notification);
        
    }  //End Method

    /**
     * Update Permission.
     */
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name,'.$permission->id
            ]
        ]);

        $permission->update([
            'name' => $request->name,
            'module_id' => $request->module_id,
        ]);

        $notification = array(
            'message' => 'Permission updated',
        );

        return redirect()->back()->with($notification);
        
    }  //End Method

    /**
     * Delete Permission.
     */
    public function destroy($id)
    {
        $permission = Permission::find($id);
        $permission->delete();

        $notification = array(
            'message' => 'Permission deleted',
        );

        return redirect()->back()->with($notification);
    }  //End Method
}
