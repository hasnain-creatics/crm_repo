<?php

use Illuminate\Database\Seeder;
use App\Models\Subject;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class SubjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $subjectsData = [
            [
                'name' => 'English',

            ],
            [
                'name' => 'Maths',

            ],
            [
                'name' => 'Finance',
            ],
            [
                'name' => 'Accounting',
                'parent_id' => 3,
            ],
            [
                'name' => 'Marketing',
            ],
            [
                'name' => 'Physics',
            ],



        ];

        foreach ($subjectsData as $key => $value){
            $subject = [
                'id' => $key + 1,
                'name' 	=> $value['name'],
                'parent_id' 	=> !empty($value['parent_id']) ? $value['parent_id'] : null,
                'created_at'	=> Carbon::now(),
                'updated_at'	=> Carbon::now(),
            ];

            Subject::create($subject);
        }
    }
}
