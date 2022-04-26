<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(CityTableSeeder::class);
         $this->call(StatusTableSeeder::class);
         $this->call(CurrencyTableSeeder::class);
         $this->call(SubjectTableSeeder::class);
         $this->call(RoleTableSeeder::class);
         $this->call(UsersTableSeeder::class);
        //  $this->call(DocumentTableSeeder::class);
        //  $this->call(SaleOrderTableSeeder::class);
        //  $this->call(SaleOrderSubjectTableSeeder::class);
        //  $this->call(SaleOrderDocumentTableSeeder::class);         
        \Artisan::call('passport:install');
        \Artisan::call('cache:clear');
    }
}
