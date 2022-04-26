<?php

use Illuminate\Database\Seeder;
use App\Models\SaleOrderSubject;
use App\Models\SaleOrder;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class SaleOrderSubjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sale_orders =  DB::table('sale_orders')->inRandomOrder()->pluck('id')->toArray();
        $subjects =  DB::table('subjects')->inRandomOrder()->pluck('id')->toArray();

        $faker = Faker::create();

        for($i = 1 ; $i < 20; $i++){
            $data = [
                'id' => $i,
                'subject_id' 	=> $faker->randomElement($subjects),
                'sale_order_id' 	=> $faker->randomElement($sale_orders),
                'created_at'	=> Carbon::now(),
                'updated_at'	=> Carbon::now(),
            ];

            SaleOrderSubject::create($data);
        }




    }
}
