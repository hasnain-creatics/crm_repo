<?php

use Illuminate\Database\Seeder;
use App\Models\Status;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::truncate();

        $data = [
            [
                'id' => 1,
                'type' => 'task',
                'title' => 'New',
                'is_active' => 1,
                'order' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 2,
                'type' => 'task',
                'title' => 'In Progress',
                'is_active' => 1,
                'order' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 3,
                'type' => 'task',
                'title' => 'Completed',
                'is_active' => 1,
                'order' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 4,
                'type' => 'task',
                'title' => 'Feedback',
                'is_active' => 1,
                'order' => 4,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 5,
                'type' => 'qa',
                'title' => 'QA In Progress',
                'is_active' => 1,
                'order' => 5,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 6,
                'type' => 'qa',
                'title' => 'Rejected',
                'is_active' => 1,
                'order' => 6,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 7,
                'type' => 'qa',
                'title' => 'Qa Approved',
                'is_active' => 1,
                'order' => 6,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 8,
                'type' => 'sales',
                'title' => 'Delivered',
                'is_active' => 1,
                'order' => 6,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];

        Status::insert($data);
    }
}
