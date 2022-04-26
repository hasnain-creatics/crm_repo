<?php

use Illuminate\Database\Seeder;
use App\Models\City;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::truncate();

        $data = [
            [
                'id' => 1,
                'title' => 'Karachi'
            ],
            [
                'id' => 2,
                'title' => 'Lahore'
            ],
            [
                'id' => 3,
                'title' => 'Rawalpindi'
            ],
            [
                'id' => 4,
                'title' => 'Sewan'
            ],
            [
                'id' => 5,
                'title' => 'Islamabad'
            ],
            [
                'id' => 6,
                'title' => 'Peshawar'
            ]
        ];

        foreach ($data as $key => $value){
            $subject = [
                'id' => $value['id'],
                'title' 	=> $value['title'],
                'created_at'	=> Carbon::now(),
                'updated_at'	=> Carbon::now()
            ];

            City::create($subject);
        }
    }
}
