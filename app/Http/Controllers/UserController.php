<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    
    /**
     * Access.
     */
    public function __construct()
    {
        $this->middleware('permission:view user', ['only' => ['ViewUsers', 'ViewUserDetails']]);
        $this->middleware('permission:edit user', ['only' => ['EditUserPermission', 'update']]);
        // $this->middleware('permission:edit permission', ['only' => ['update']]);
        // $this->middleware('permission:delete permission', ['only' => ['destroy']]);
    }
    /**
     * View Users.
     */
    public function ViewUsers()
    {
       
        $users = User::get();
        return view('admin.role_permission.user.view_users', compact('users'));
    } //End method --------------------

    /**
     * View User Details.
     */
    public function ViewUserDetails()
    {
       
        $users = User::get();
        return view('admin.role_permission.user.view_user_details', compact('users'));
    } //End method --------------------

    /**
     * Edit User Permission.
     */
    public function EditUserPermission($id)
    {
       
        $user = User::findOrFail($id);
        $roles = Role::get();
        $userRole = $user->roles->pluck('name', 'name')->all();
        return view('admin.role_permission.user.edit_user_permission', compact('user', 'roles', 'userRole'));
    } //End method --------------------


    /**
     * Save User Permission.
     */
    public function update(Request $request, User $user)
    {

        $data = [
            'status' => $request->status,
        ]; 

       
        $user->update($data);
        $user->syncRoles($request->role);

        $notification = array(
            'message' => 'User Permission Updated',
        );

        return redirect()->back()->with($notification);

    } //End method --------------------


}
