<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\SaleOrder;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class SaleOrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersTable =  DB::table('users')->inRandomOrder()->pluck('id')->toArray();
        $documents =  DB::table('documents')->inRandomOrder()->pluck('id')->toArray();
        $currency =  DB::table('currencies')->inRandomOrder()->pluck('id')->toArray();
        $faker = Faker::create();

        for($i = 1 ; $i < 20; $i++){
            $sale_order = [
                'id' => $i,
                'title' 	=> $faker->text(10),
                'created_by_user_id' 	=> $faker->randomElement($usersTable),
                'word_count' 		=> $faker->randomNumber(4),
                'currency_id' =>$faker->randomElement($currency),
                'customer_name' 	=> $faker->lastName,
                'customer_email' 	=> $faker->email,
                'customer_type' => $faker->randomElement(['EXISTING', 'NEW', 'REFFERAL']),
                'payment_status' => $faker->randomElement(['PAID', 'UNPAID', 'PARTIALLY PAID']),
                'status' => $faker->randomElement(['ACTIVE', 'DISABLED', 'PENDING']),
                'amount' => $faker->randomNumber(3),
                'amount_received' => $faker->randomNumber(2),
                'deadline' => Carbon::now()->addDays(rand(4, 7)),
                'notes' => $faker->text(100),
                'additional_notes' => $faker->text(20),
                'invoice_file_id' => $faker->randomElement($documents),
                'start_date_time' => Carbon::now()->addDays(rand(1, 2)),
                'end_date_time' => Carbon::now()->addDays(rand(3, 4)),
                'created_at'	=> Carbon::now(),
                'updated_at'	=> Carbon::now(),
            ];

            SaleOrder::create($sale_order);
        }




    }
}
