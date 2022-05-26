<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Website;
use Auth;
use DB;
use Validator;
class WebsiteController extends Controller
{
 
    public function __construct(){

        $this->middleware('permission:websites-add', ['only' => ['create','update']]);
         
        $this->middleware('permission:websites-edit', ['only' => ['edit','update']]);
        
        $this->middleware('permission:websites-delete', ['only' => ['destroy']]);

        $this->middleware('permission:websites-view', ['only' => ['index']]);
         
    }
    public function index(Request $request)
    {       
       return view('website.index');
    }
    
    public function get_website(Website $website){


        $data = $website->get();

        return response()->json($data);


    }

    public function get_active_website(Website $website){


        $data = $website->where('status','ACTIVE')->get();

        return response()->json($data);


    }


    public function create()
    {
        
        return view('website.add');
    
    }
  
public function store(Request $request,Website $websites)
{

    $rules = [
        'name'      =>'required',
        'status'      =>'required'
    ];
    $messages = [
        'name'      =>'Name is required',
        'status'      =>'Status Type is required'
    ];

    $validator = Validator::make( $request->all(), $rules, $messages );

    if ( $validator->fails() ) 
    {
        $data = [
            'success' => 0, 
            'message'=>$validator->errors()
        ];
    }else{
        
        $form_data = [
            'name'   =>$request['name'],
            'status'   =>$request['status']
        ];

        // dd($form_data);
        
        if(isset($request['id'])){

            $role_already_exists = Website::where('id','!=',$request['id'])
                                            ->where('name',trim($request['name']))
                                            ->first();
           
            if($role_already_exists){
                return response([
                    'success' => 0, 
                    'message'=> 'Website already exists'
                ], 200)->header('Content-Type', 'text/plain');
            }
            
            Website::where('id',$request['id'])->update($form_data);

            $message = "Website update successfully!";

        }else{

            
            $role_already_exists = Website::where('name',trim($request['name']))->first();
            
            if($role_already_exists){
                return response([
                    'success' => 0, 
                    'message'=> 'Website already exists'
                ], 200)->header('Content-Type', 'text/plain');
            }
            

            Website::create($form_data);

            $message ='Website Updated Successfully';

        }
        
        $data =  [
            'success' => 1, 
            'message'=> $message
        ];
    }
    return response($data, 200)->header('Content-Type', 'text/plain');

}

public function edit($id)
    {
       return view('website.edit',compact('id'));
    }

public function get_single_website($id){

    $result = Website::find($id);

    return response($result, 200)->header('Content-Type', 'text/plain');

}



}


