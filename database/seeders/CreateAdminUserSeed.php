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
        User::truncate();

        User::create([
                'name'=>'admin',
                'email'=>'admin@admin.com',
                'password'=>bcrypt('123456')
        ])->assignRole([
'Admin'
        ]);
        // $user =[
          
        //     'first_name' => 'Sale Manager',
        //     'last_name' => 'User',
        //     'email' => 'sale_manager@management.com',
        //     'password' => Hash::make('task1234567'),
        //     'designation' => "administrator",
        //     'status' => 'ACTIVE',
        //     'remember_token' => Hash::make('task1234567'),
        //     'created_at'    => date('Y-m-d'),
        //     'updated_at'    => date('Y-m-d')
        // ];

        // $user = User::create($user);
        // $user =[
        //     'first_name' => 'Sale Agent',
        //     'last_name' => 'User',
        //     'email' => 'sale_agent@management.com',
        //     'password' => Hash::make('task1234567'),
        //     'designation' => "administrator",
        //     'status' => 'ACTIVE',
        //     'remember_token' => Hash::make('task1234567'),
        //     'created_at'	=> date('Y-m-d'),
        //     'updated_at'	=> date('Y-m-d')
        // ];

        // $user = User::create($user);
        // $user =[
           
        //     'first_name' => 'Writer Manager',
        //     'last_name' => 'User',
        //     'email' => 'writer_manager@management.com',
        //     'password' => Hash::make('task1234567'),
        //     'designation' => "administrator",
        //     'status' => 'ACTIVE',
        //     'remember_token' => Hash::make('task1234567'),
        //     'created_at'    => date('Y-m-d'),
        //     'updated_at'    => date('Y-m-d')
        // ];

        // $user = User::create($user);

        
        // $user =[
     
        //     'first_name' => 'Writer',
        //     'last_name' => 'User',
        //     'email' => 'writer@management.com',
        //     'password' => Hash::make('task1234567'),
        //     'designation' => "administrator",
        //     'status' => 'ACTIVE',
        //     'remember_token' => Hash::make('task1234567'),
        //     'created_at'	=> date('Y-m-d'),
        //     'updated_at'	=> date('Y-m-d')
        // ];

        // $user = User::create($user);

      
        // $user =[
        //             'first_name' => 'IT',
        //     'last_name' => 'User',
        //     'email' => 'it@management.com',
        //     'password' => Hash::make('task1234567'),
        //     'designation' => "administrator",
        //     'status' => 'ACTIVE',
        //     'remember_token' => Hash::make('task1234567'),
        //     'created_at'	=> date('Y-m-d'),
        //     'updated_at'	=> date('Y-m-d')
        // ];

        // $user = User::create($user);

        // $user =[
        
        //     'first_name' => 'HR',
        //     'last_name' => 'User',
        //     'email' => 'hr@management.com',
        //     'password' => Hash::make('task1234567'),
        //     'designation' => "administrator",
        //     'status' => 'ACTIVE',
        //     'remember_token' => Hash::make('task1234567'),
        //     'created_at'	=> date('Y-m-d'),
        //     'updated_at'	=> date('Y-m-d')
        // ];

        // $user = User::create($user);

    }
}
