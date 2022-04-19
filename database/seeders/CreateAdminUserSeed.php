<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class CreateAdminUserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        User::create([
                'name'=>'admin',
                'email'=>'admin@admin.com',
                'password'=>bcrypt('123456')
        ])->assignRole([
            Role::create([
                'name'=>'Admin'
            ])->id
        ]);

    }
}
