<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        Role::truncate();
        
        $data = [
            [
                'id' => 1,
                'title' => 'Admin',
                'description' => '',
                'scope' => [],
            ],
            [
                'id' => 2,
                'title' => 'Sale Manager',
                'description' => '',
                'scope' => [],
            ],
            [
                'id' => 3,
                'title' => 'Sale Agent',
                'description' => '',
                'scope' => [],
            ],
            [
                'id' => 4,
                'title' => 'Writer Manager',
                'description' => '',
                'scope' => [],
            ],
            [
                'id' => 5,
                'title' => 'Writer',
                'description' => '',
                'scope' => [],
            ],
            [
                'id' => 6,
                'title' => 'IT',
                'description' => '',
                'scope' => [],
            ],
            [
                'id' => 7,
                'title' => 'HR',
                'description' => '',
                'scope' => [],
            ],
        ];

        foreach ($data as $key => $value){
            $subject = [
                'id' => $value['id'],
                'title' 	=> $value['title'],
                'description' 	=> $value['description'],
                'scope' 	=> $value['scope'],
                'created_at'	=> Carbon::now(),
                'updated_at'	=> Carbon::now()
            ];

            Role::create($subject);
        }
    }
}
