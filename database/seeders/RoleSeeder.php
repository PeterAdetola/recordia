<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// use Carbon\Carbon;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // $currentDateTime = Carbon::now();

        $permission = new Permission();
        $permission->name = 'add-expense';
        $permission->save();

        $role = new Role();
        $role->name = 'admin';
        $role->save();
        $role->permissions()->attach($permission);
        $permission->roles()->attach($role);

        $permission = new Permission();
        $permission->name = 'add-donor';
        $permission->save();

        $role = new Role();
        $role->name = 'recorder';
        $role->save();
        $role->permissions()->attach($permission);
        $permission->roles()->attach($role);

        $admin = Role::where('name', 'admin')->first();
        $userRole = Role::where('name', 'recorder')->first();
        $add_expense = Permission::where('name', 'add-expense')->first();
        $add_donor = Permission::where('name', 'add-donor')->first();

        $admin = new User();
        $admin->name = 'Peter Adetola';
        $admin->username = 'Pter';
        $admin->email = 'peter@gmail.com';
        // $user->email_verified_at = '2023-09-05 14:10:43';
        $admin->password = bcrypt('password');
        $admin->save();
        $admin->roles()->attach($admin);
        $admin->permissions()->attach($add_donor);

        $user = new User();
        $user->name = 'Eugene Bassey';
        $user->username = 'Eugene';
        $user->email = 'eugene@gmail.com';
        // $user->email_verified_at = '2023-09-05 14:10:43';
        $user->password = bcrypt('password');
        $user->save();
        $user->roles()->attach($userRole);
        $user->permissions()->attach($add_donor);

        $user = new User();
        $user->name = 'Felicia Ijeh';
        $user->username = 'Felicia';
        $user->email = 'felicia@gmail.com';
        // $user->email_verified_at = '2023-09-05 14:10:43';
        $user->password = bcrypt('password');
        $user->save();
        $user->roles()->attach($userRole);
        $user->permissions()->attach($add_donor);
    }
}
