<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departments; 
class DepartmentsController extends Controller
{
   
    public function fetch_active_department(){
        
        $departments = new Departments();

        $result = $departments->get();

        if($result){

            return response()->json(['status'=>'success','data'=>$result]);    

        }else{

            response()->json(['status'=>'error','data'=>[]]);    

        }

    }

}
