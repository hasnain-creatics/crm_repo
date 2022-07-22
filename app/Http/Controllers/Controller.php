<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Traits\HandShakingTrait;
use Illuminate\Support\Facades\Artisan;
use App\Http\Traits\DataTableTrait;
use App\Http\Traits\UserTrait;
use App\Datatables\GlobalDatatables;
use App\Models\User;
use Auth;
class Controller extends BaseController
{
     
     use AuthorizesRequests, DispatchesJobs, ValidatesRequests,HandShakingTrait,DataTableTrait,UserTrait;
     // public function __construct(){

     //      Artisan::call('cache:clear');
     //      Artisan::call('cache:forget spatie.permission.cache');

         
     // }
}
