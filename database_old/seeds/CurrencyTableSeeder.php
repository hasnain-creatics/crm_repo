<?php

use Illuminate\Database\Seeder;
use App\Models\Currency;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class CurrencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $currencyData = [
          [
            'currency' => 'Taka',
            'code' => 'BDT',
            'rate' => 105.10,
          ],
          [
            'currency' => 'Canadian Dollar',
            'code' => 'CAD',
              'rate' => 1.5,
          ],
          [
            'currency' => 'Euro',
            'code' => 'EUR',
              'rate' => 12,
          ],
          [
            'currency' => 'Indian Rupee',
            'code' => 'INR',
              'rate' => 55.65,
          ],
          [
            'currency' => 'Pakistani Rupee',
            'code' => 'PKR',
              'rate' => 150.85,
          ],


        ];

        foreach ($currencyData as $key => $value){
            $currency = [
                'id' => $key + 1,
                'currency' 	=> $value['currency'],
                'code' 	=> $value['code'],
                'rate' 	=> $value['rate'],
                'created_at'	=> Carbon::now(),
                'updated_at'	=> Carbon::now(),
            ];

            Currency::create($currency);
        }
    }
}
