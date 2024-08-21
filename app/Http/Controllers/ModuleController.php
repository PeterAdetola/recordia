<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;

class ModuleController extends Controller
{

    /**
     * View Modules.
     */
    public function ViewModules()
    {

        $modules = Module::all();

        return view('admin.role_permission.module.view_modules', compact('modules'));

    } //End Method
    

    /**
     * Save Module.
     */
    public function SaveModule(Request $request)
    {

        $request->validate([
            'name' => 'required',
        ],[
            'name.required' => 'Name is required',
        ]);

        $max_no = Module::max('order');
        $order = $max_no + 1;
        $status = 1;

            Module::insert([
                'order' => $order,
                'name' => $request->name,
                'status' => $status,
            ]);

        $notification = array(
            'message' => 'Module saved',
        );

        return redirect()->back()->with($notification);

    }  //End Method

    /**
     * Update resource in storage.
     */
    public function UpdateModule(Request $request)
    {

        $id = $request->id;

            Module::findOrFail($id)->update([
                'name' => $request->name,
                ]);

        $notification = array(
            'message' => 'Module updated',
            );

        return redirect()->back()->with($notification);

    }  //End Method

    /**
     * Delete Stat.
     */
    public function DeleteModule($id)
    {
        
        $module = Module::findOrFail($id); 


        Module::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Module deleted',
        );

        return redirect()->back()->with($notification);

    } //End Method
}
