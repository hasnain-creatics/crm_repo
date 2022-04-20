<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\UserRole;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // const ADMIN = 1;
        // const SALE_MANAGER = 2;
        // const SALE_AGENT = 3;
        // const WRITER_MANAGER = 4;
        // const WRITER = 5;
        // const IT = 6;
        // const HR = 7;

        UserRole::truncate();
        User::truncate();

        $user = [
            'id' => 1,
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@management.com',
            'password' => Hash::make('task1234567'),
            'status' => 'ACTIVE',
            'remember_token' => Hash::make('task1234567'),
            'created_at'	=> Carbon::now(),
            'updated_at'	=> Carbon::now(),
        ];

        $user = User::create($user);

        UserRole::create([
            'user_id' => $user->id,
            'role_id' => Role::ADMIN
        ]);

        $user =[
            'id' => 2,
            'first_name' => 'Sale Manager',
            'last_name' => 'User',
            'email' => 'sale_manager@management.com',
            'password' => Hash::make('task1234567'),
            'designation' => "administrator",
            'status' => 'ACTIVE',
            'remember_token' => Hash::make('task1234567'),
            'created_at'	=> Carbon::now(),
            'updated_at'	=> Carbon::now(),
        ];

        $user = User::create($user);

        UserRole::create([
            'user_id' => $user->id,
            'role_id' => Role::SALE_MANAGER
        ]);

        $user =[
            'id' => 3,
            'first_name' => 'Sale Agent',
            'last_name' => 'User',
            'email' => 'sale_agent@management.com',
            'password' => Hash::make('task1234567'),
            'designation' => "administrator",
            'status' => 'ACTIVE',
            'remember_token' => Hash::make('task1234567'),
            'created_at'	=> Carbon::now(),
            'updated_at'	=> Carbon::now(),
        ];

        $user = User::create($user);

        UserRole::create([
            'user_id' => $user->id,
            'role_id' => Role::SALE_AGENT
        ]);

        $user =[
            'id' => 4,
            'first_name' => 'Writer Manager',
            'last_name' => 'User',
            'email' => 'writer_manager@management.com',
            'password' => Hash::make('task1234567'),
            'designation' => "administrator",
            'status' => 'ACTIVE',
            'remember_token' => Hash::make('task1234567'),
            'created_at'	=> Carbon::now(),
            'updated_at'	=> Carbon::now(),
        ];

        $user = User::create($user);

        UserRole::create([
            'user_id' => $user->id,
            'role_id' => Role::WRITER_MANAGER
        ]);

        $user =[
            'id' => 5,
            'first_name' => 'Writer',
            'last_name' => 'User',
            'email' => 'writer@management.com',
            'password' => Hash::make('task1234567'),
            'designation' => "administrator",
            'status' => 'ACTIVE',
            'remember_token' => Hash::make('task1234567'),
            'created_at'	=> Carbon::now(),
            'updated_at'	=> Carbon::now(),
        ];

        $user = User::create($user);

        UserRole::create([
            'user_id' => $user->id,
            'role_id' => Role::WRITER
        ]);

        $user =[
            'id' => 6,
            'first_name' => 'IT',
            'last_name' => 'User',
            'email' => 'it@management.com',
            'password' => Hash::make('task1234567'),
            'designation' => "administrator",
            'status' => 'ACTIVE',
            'remember_token' => Hash::make('task1234567'),
            'created_at'	=> Carbon::now(),
            'updated_at'	=> Carbon::now(),
        ];

        $user = User::create($user);

        UserRole::create([
            'user_id' => $user->id,
            'role_id' => Role::IT
        ]);

        $user =[
            'id' => 7,
            'first_name' => 'HR',
            'last_name' => 'User',
            'email' => 'hr@management.com',
            'password' => Hash::make('task1234567'),
            'designation' => "administrator",
            'status' => 'ACTIVE',
            'remember_token' => Hash::make('task1234567'),
            'created_at'	=> Carbon::now(),
            'updated_at'	=> Carbon::now(),
        ];

        $user = User::create($user);

        UserRole::create([
            'user_id' => $user->id,
            'role_id' => Role::IT
        ]);
    }


}
