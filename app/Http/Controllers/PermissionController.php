<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Models\Module;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class PermissionController extends Controller
{
    public function ViewPermissions()
    {
       
        // $modules = Module::get();
        $modules = Module::whereHas('permissions')->with('permissions')->get();
        $permissions = Permission::get();
        return view('admin.role_permission.permission.view_permissions', compact('permissions', 'modules'));
    }

    /**
     * Store Permission.
     */
public function store(Request $request)
    {

        // dd($request->all());
        // exit();

        //  $request->validate([
        //     'name' => 'required',
        //     'module_id' => 'required',
        // ]);

         $validator = Validator::make($request->all(), [
        'name' => 'required',
        'module_id' => 'required',
    ]);

         if ($validator->fails()) {
         $notification = array(
            'message' => 'Please check your inputs.',
        );

        return redirect()->back()->with($notification);

        // return redirect()->back()
        //                  ->withErrors($validator)
        //                  ->with('notification', $notification);
    }

        list($moduleId, $moduleName) = explode('-', $request->module_id);
        $name = $request->name.' '.$moduleName;

       
     if (Permission::where('name', $name)->exists()) {

        $notification = array(
            'message' => 'Permission already exists',
        );

        return redirect()->back()->with($notification);
     }
        Permission::create([
            'name' => $name,
            'module_id' => $moduleId,
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

        // dd($request->all());
        // exit();
        list($moduleId, $moduleName) = explode('-', $request->module_id);
        $name = $request->name.' '.$moduleName;


     if (Permission::where('name', $name)->exists()) {

        $notification = array(
            'message' => 'Permission already exists',
        );

        return redirect()->back()->with($notification);
     }

        $permission->update([
            'name' => $name,
            'module_id' => $moduleId,
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
