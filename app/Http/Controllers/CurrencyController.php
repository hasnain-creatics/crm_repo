<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Subjects;
use App\Models\Documents;
use App\Models\Currency;
use App\Models\Sale_Order_Documents as OrderDocuments;
use Illuminate\Http\Request;
use Auth;
use DB;
use Validator;
use Illuminate\Support\Facades\Http;
class CurrencyController extends Controller
{

    
    public function __construct(){

        $this->middleware('permission:currency-add', ['only' => ['create','update']]);
         
        $this->middleware('permission:currency-edit', ['only' => ['edit','update']]);
        
        $this->middleware('permission:currency-delete', ['only' => ['destroy']]);

        $this->middleware('permission:currency-view', ['only' => ['index']]);
         
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {       
       return view('currency.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('currency.add');
    }

    public function get_all_subjects(Currency $currency){

        $result = $currency->get();

        return response()->json($result);


    }
    public function get_subject(Currency $subject,$id){

        $data =  $subject->find($id);

        return response()->json($data);

    }

    public function edit($id)
    {
        $data['id']  = $id;

        return view('currency.edit',$data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Currency $leads)
    {
        $rules['currency'] = 'required';
        $rules['rate'] = 'required';
        $rules['code'] = 'required';
      
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
    
                        $order_updated->{$key} = $request->$key;    

            }

            $order_updated->save();
     
            $data = [

                'success' => true, 

                'message'=>'Currency Updated Successfully'

            ];
        }
        
        return response($data, 200)->header('Content-Type', 'text/plain');
    }

    public function sync(){

        $response = Http::get('https://v6.exchangerate-api.com/v6/9fa637f28f55aa3b7ba056ea/latest/USD');

        $conversion_rate = $response['conversion_rates'];

        $currencies = [];

        foreach(Currency::get() as $curreny_key=>$currency_value){

            $currencies[] = $currency_value->code;

        }

        foreach($conversion_rate as $key=>$value){
            
            if (in_array($key,  $currencies)){

                Currency::where('code',$key)->update(['rate'=>$value]);

            }
          
        }
       
        return response()->json(['status'=>'success','message'=>'currency updated successfully']);
   
    }
}
