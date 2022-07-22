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
    public function get_all_active_currency(Currency $currency){

        $result = $currency->get();

        return response()->json($result);


    }

    public function get_all_subjects(Currency $currency){

        $result = $currency->paginate(10);

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

    public function exchange_rate($currency){
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.apilayer.com/fixer/latest?symbols={$currency}&base=USD",
          CURLOPT_HTTPHEADER => array(
            "Content-Type: text/plain",
            "apikey: d3b81bac49506e92d745bffb3a2b1314"
          ),
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET"
        ));
        
        $response = json_decode(curl_exec($curl));
        
        curl_close($curl);
        return $response;
    }

    public function sync(){




        foreach(Currency::get() as $curreny_key=>$currency_value){

         
            $rate = $this->exchange_rate($currency_value->code);
            if($rate->success == 1){
    
              Currency::where('code',$currency_value->code)->update(['rate'=>$rate->rates->{$currency_value->code}]);
            }
           
        }
        return response()->json(['status'=>'success','message'=>'currency updated successfully']);
        
 
      
        die;


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
