<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function manageRole()
    {
       
        $roles = Role::get();
        return view('admin.role_permission.view_roles', compact('roles'));
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

        Role::create([
            'name' => $request->name,
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
}
