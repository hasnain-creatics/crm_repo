<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Subjects;
use App\Models\Documents;
use App\Models\Sale_Order_Documents as OrderDocuments;
use Illuminate\Http\Request;
use Auth;
use DB;
use Validator;
class SubjectsController extends Controller
{

    
    public function __construct(){

        $this->middleware('permission:subjects-add', ['only' => ['create','update']]);
         
        $this->middleware('permission:subjects-edit', ['only' => ['edit','update']]);
        
        $this->middleware('permission:subjects-delete', ['only' => ['destroy']]);

        $this->middleware('permission:subjects-view', ['only' => ['index']]);
         
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {       
       return view('subjects.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('subjects.add');
    }

    public function get_all_active_subjects(){
        $data = new Subjects();

        $result = $data->get();

        return response()->json($result);
    }
    public function get_all_subjects(){

          
        $data = new Subjects();

        $result = $data->paginate(5);

        return response()->json($result);


    }
    public function get_subject(Subjects $subject,$id){
        $data =  $subject->find($id);

        return response()->json($data);

    }

    public function edit($id)
    {
        $data['id']  = $id;

        return view('subjects.edit',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Subjects $leads)
    {
        $rules['name'] = 'required';
      
        $validator = Validator::make( $request->all(), $rules);

        if ( $validator->fails() ) 
        {
            $data = [
                'success' => false, 
                'message'=>$validator->errors()
            ];

        }else{

            $order_updated = $leads;

            if(isset($request->id)){
            
                $order_updated = $leads->find($request->id);
            
            }

            foreach($rules as $key=>$value){
                if($key!='subject_id'){
                        $order_updated->{$key} = $request->$key;    

                        if(isset($request->id)){
                            $order_updated['updated_at'] = date('Y-m-d');
        
                        }else{
        
                            $order_updated['created_at'] = date('Y-m-d');
                          
                        }
                }
            }

            $order_updated->save();
     
            $data = [

                'success' => true, 

                'message'=>'Subject Updated Successfully'

            ];
        }
        
        return response($data, 200)->header('Content-Type', 'text/plain');
    }

    public function destroy(Subjects $issue,$id)
    {
         $users =  $issue->findOrFail($id);
        $users->delete();
        return redirect()->back()->with('success', 'Subject deleted successfully!');   
    }

}
