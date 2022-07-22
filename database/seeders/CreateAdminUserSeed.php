<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Carbon;
use Hash;
class CreateAdminUserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $permission_array = ['user-view',
                             'user-add',
                             'user-edit',
                             'user-delete',
                             'role-view',
                             'role-add',
                             'role-edit',
                             'role-delete',
                             'permission'];

        $role = Role::createe(['name'=>'Admin']);
        
        foreach($permission_array as $perm_value){

            $crate_permissions = Permission::create(['name'=>$perm_value]);

            $role->syncPermissions($crate_permissions);
        
        }

        $default_roles = ['Sale Manager',
                          'Sale Agent',
                          'Writer Manager',
                          'Writer',
                          'IT',
                          'HR'];

        foreach($default_roles as $default_value){

            Role::create(['name'=>$default_value]);
            
        }
        $user = User::create([
                'name'=>'admin',
                'email'=>'admin@admin.com',
                'password'=>bcrypt('123456')
        ])->assignRole(['admin']);

    }
}
