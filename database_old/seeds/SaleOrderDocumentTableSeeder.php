<?php

use Illuminate\Database\Seeder;
use App\Models\SaleOrderDocument;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class SaleOrderDocumentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sale_orders =  DB::table('sale_orders')->inRandomOrder()->pluck('id')->toArray();
        $documents =  DB::table('documents')->inRandomOrder()->pluck('id')->toArray();

        $faker = Faker::create();

        for($i = 1 ; $i < 20; $i++){
            $data = [
                'id' => $i,
                'document_id' 	=> $faker->randomElement($documents),
                'sale_order_id' 	=> $faker->randomElement($sale_orders),
                'created_at'	=> Carbon::now(),
                'updated_at'	=> Carbon::now(),
            ];

            SaleOrderDocument::create($data);
        }




    }
}
