<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Modules;
class CreateModulesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect(['Users','Orders','Sales','Leads','Notice','Currency'])->each(function($item,$key){
            Modules::create(['name'=>$item,'url'=>'/']);
        });
        
    }
}
