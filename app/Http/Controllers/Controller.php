<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Traits\HandShakingTrait;

use App\Http\Traits\DataTableTrait;
use App\Http\Traits\UserTrait;
use App\Datatables\GlobalDatatables;
class Controller extends BaseController
{
     use AuthorizesRequests, DispatchesJobs, ValidatesRequests,HandShakingTrait,DataTableTrait,UserTrait;
}
