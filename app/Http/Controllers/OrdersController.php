<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Documents;
use App\Models\Sale_Order_Documents as OrderDocuments;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Status;
use Validator;
use App\Models\OrderAssigns;
class OrdersController extends Controller
{

    public function __construct(){

        $this->middleware('permission:orders-add', ['only' => ['create','update']]);
         
        $this->middleware('permission:orders-edit', ['only' => ['edit','update']]);
        
        $this->middleware('permission:orders-delete', ['only' => ['destroy']]);

        $this->middleware('permission:orders-view', ['only' => ['index']]);
         
    }


    public function order_timline($id){
        $status = OrderAssigns::select('status_id')
                                        ->where('sale_order_id',$id)
                                        ->orderBy('id','desc')
                                        ->take(1)->get();
                                     
        if(count($status)>0){
                $current_status = $status[0]->status_id;
        }else{
                $current_status = 'New';
        }

        return view('modals.orders.order_timline',compact('id','current_status'));

    }

    public function index(Request $request)
    {       
        if ($request->ajax()) {

        $data = new Orders();

        $data = $data->select('sale_orders.*','users.first_name','documents.url as doc_url');

                        // $data = $data->leftJoin('lead_issues','lead_issues.id','=','leads.lead_issue_id');

                        $data = $data->join('users','users.id','=','sale_orders.created_by_user_id');

                        $data = $data->leftJoin('sale_order_documents','sale_order_documents.sale_order_id','=','sale_orders.id');

                        $data = $data->leftJoin('documents','documents.id','=','sale_order_documents.document_id');

                        // $data = $data->leftJoin('lead_transfers lt','lt.lead_id','=','leads.id');

                        if(isset($_GET['order_id'])&& !empty($_GET['order_id'])){
   
                            $order_id = $_GET['order_id']; 
             
                            $data = $data->where('sale_orders.order_id',$_GET['order_id']);     
                    
                        }

                        if(isset($_GET['customer_email'])&& !empty($_GET['customer_email'])){
   
                            $customer_email = $_GET['customer_email']; 
             
                            $data = $data->where('sale_orders.customer_email',$_GET['customer_email']);     
                    
                        }

                        if(isset($_GET['payment_status'])&& !empty($_GET['payment_status'])){
   
                            $status = $_GET['payment_status']; 
             
                            $data = $data->where('sale_orders.payment_status',$_GET['payment_status']);     
                    
                        }

                        // if(isset($_GET['url'])&& !empty($_GET['url'])){
   
                        //     $url = $_GET['url']; 
             
                        //     $data = $data->where('leads.url',$_GET['url']);     
                    
                        // }

                        // if(isset($_GET['name'])&& !empty($_GET['name'])){
   
                        //     $name = $_GET['name']; 

                        //     $data = $data->where('leads.first_name','LIKE','%'.$name.'%');     

                        //     $data = $data->orWhere('leads.last_name','LIKE','%'.$name.'%');  

                        // }
                        

                        if(isset($_GET['date_start'])&& !empty($_GET['date_start'])){
       
                            $date_start = $_GET['date_start'] ." 00:00:00";
                            
                            $data = $data->where('sale_orders.created_at','>=',$date_start);     
                    
                        }

                        if(isset($_GET['date_end'])&& !empty($_GET['date_end'])){
   
                            $date_end = $_GET['date_end'] ." 23:59:59";
             
                            $data = $data->where('sale_orders.created_at','<=',$date_end);     
                    
                        }

                            if($this->is_admin() != true){

                                // $data = $data->where('leads.transfered_id',Auth::user()->id);

                                if(Auth::user()->roles[0]->type == 'manager'){

                                    $data = $data->orWhere('users.assigned_to',Auth::user()->id);

                                }else{
                                    
                                    if(Auth::user()->is_lead){

                                        $data = $data->orWhere('users.lead_id',Auth::user()->id);
                     
                                    }
                                }
                              
                            }

            $data = $data->orderBy('sale_orders.id','DESC');          

            return $this->table($data,'orders');   
        
    }
       return view('orders.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_old(Request $request)
    {       
        if ($request->ajax()) {

        $data = new Orders();

        $data = $data->select('sale_orders.*','users.first_name','documents.url as doc_url');

                        // $data = $data->leftJoin('lead_issues','lead_issues.id','=','leads.lead_issue_id');

                        $data = $data->join('users','users.id','=','sale_orders.created_by_user_id');

                        $data = $data->leftJoin('sale_order_documents','sale_order_documents.sale_order_id','=','sale_orders.id');

                        $data = $data->leftJoin('documents','documents.id','=','sale_order_documents.document_id');

                        // $data = $data->leftJoin('lead_transfers lt','lt.lead_id','=','leads.id');

                        // if(isset($_GET['lead_id'])&& !empty($_GET['lead_id'])){
   
                        //     $lead_id = $_GET['lead_id']; 
             
                        //     $data = $data->where('leads.lead_id',$_GET['lead_id']);     
                    
                        // }

                        // if(isset($_GET['email'])&& !empty($_GET['email'])){
   
                        //     $email = $_GET['email']; 
             
                        //     $data = $data->where('leads.email',$_GET['email']);     
                    
                        // }

                        // if(isset($_GET['status'])&& !empty($_GET['status'])){
   
                        //     $status = $_GET['status']; 
             
                        //     $data = $data->where('leads.lead_status',$_GET['status']);     
                    
                        // }

                        // if(isset($_GET['url'])&& !empty($_GET['url'])){
   
                        //     $url = $_GET['url']; 
             
                        //     $data = $data->where('leads.url',$_GET['url']);     
                    
                        // }

                        // if(isset($_GET['name'])&& !empty($_GET['name'])){
   
                        //     $name = $_GET['name']; 

                        //     $data = $data->where('leads.first_name','LIKE','%'.$name.'%');     

                        //     $data = $data->orWhere('leads.last_name','LIKE','%'.$name.'%');  

                        // }
                            if($this->is_admin() != true){

                                // $data = $data->where('leads.transfered_id',Auth::user()->id);

                                if(Auth::user()->roles[0]->type == 'manager'){

                                    $data = $data->orWhere('users.assigned_to',Auth::user()->id);

                                }else{
                                    
                                    if(Auth::user()->is_lead){

                                        $data = $data->orWhere('users.lead_id',Auth::user()->id);
                     
                                    }
                                }
                              
                            }

            $data = $data->orderBy('sale_orders.id','DESC');          

            return $this->table($data,'orders');   
        
    }
       return view('orders.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($lead_id=null)
    {
        $data['lead_id'] = $lead_id;
        
        return view('orders.add',$data);
    }

    public function edit($id=null)
    {
        $data['id'] = $id;
        
        return view('orders.edit',$data);
    }

    public function order_lead($lead_id){
        
        $data['lead_id'] = $lead_id;
        
        return view('orders.add',$data);
    }

    public function fetch_order($id=null,Orders $order){
        
        $result = $order->find($id);
        
        $data = [

            'data' => [],

            'deadline' => "",

            'success' => false, 

            'message'=>'Order not found Successfully'

        ];

        if($result){

            
            $data = [
                'data' => $result,

                'deadline' =>date('Y-m-d\TH:i', strtotime($result->deadline)),
                
                'success' => true, 
    
                'message'=>'Order found Successfully'
    
            ];

        }
    
        return response()->json($data);

    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Orders $leads)
    {
        $rules['customer_name'] = 'required';
        $rules['customer_email'] = 'required';
        $rules['customer_type'] = 'required';
        $rules['title'] = 'required';
        $rules['word_count'] = 'required';
        $rules['subject_id'] = 'required';
        $rules['deadline'] = 'required';
        $rules['payment_status'] = 'required';
        $rules['currency_id'] = 'required';
        $rules['amount'] = 'required';
        $rules['notes'] = 'required';
        $rules['additional_notes'] = 'required';
        $rules['website'] = 'required';
        $rules['lead_id'] = '';
        // $rules['is_urgent'] = '';
        // $rules['files'] = 'required';
        $change_status = true;
        if($request->payment_status == 'Partially Paid'){

            $rules['amount_received'] = 'required';
           
        }

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
                $change_status = false;
                $order_updated = $leads->find($request->id);
            
            }else{

                $rules['created_by_user_id'] = Auth::user()->id;

            }
            
            foreach($rules as $key=>$value){

                if($key!='subject_id'){

                        $order_updated->{$key} = $request->$key;    

                        if(isset($request->id)){
        
                        }else{
        
                            $order_updated['created_by_user_id'] = Auth::user()->id;
                        }
                }

              $order_updated->is_urgent = $request->is_urgent ? 1 : 0;

           
              $order_updated['subject_id'] = (int)$request->subject_id;
                
            }
            $order_updated->save();
            
            $lead_id = $order_updated->id;

            $find_lead_id = $leads->find($lead_id);

            $find_lead_id->order_id = "ORDER-{$lead_id}";
            
            $find_lead_id->save();

            if ($request->file('files')) {
                
                $file = $request->file('files');

                for($i=0;$i<count($file);$i++){

                    $lead_file_name = 'order-data-'.date('YmdHis').'.'.$file[$i]->getClientOriginalExtension();

                    $original_file_name = $file[$i]->getClientOriginalExtension();

                    $path = $file[$i]->storeAs("orders_files/order_{$lead_id}", $lead_file_name);
            
                    $leads_files          =  new Documents();
            
                    $leads_files->name = $lead_file_name;

                    // $leads_files->original_name = $file[$i]->getClientOriginalName();

                    $leads_files->file_type = $file[$i]->getClientOriginalExtension();
                    
                    $leads_files->url = url("storage/app/orders_files/order_{$lead_id}");
                    
                    $leads_files->created_at = date('Y-m-d');
        
                    $leads_files->save();
                    
                    $leads_documents = new OrderDocuments();
              
                    $leads_docs_array = ['document_id' =>$leads_files->id,'sale_order_id'=>$lead_id]; 
        
                    $leads_documents->create($leads_docs_array);
                    
                }
            
            }

            
            if ($request->file('invoice_files')) {
                
                $file = $request->file('invoice_files');

                for($i=0;$i<count($file);$i++){

                    $lead_file_name = 'order-invoice-data-'.date('YmdHis').'.'.$file[$i]->getClientOriginalExtension();

                    $original_file_name = $file[$i]->getClientOriginalExtension();

                    $path = $file[$i]->storeAs("orders_files/order_{$lead_id}", $lead_file_name);
            
                    $leads_files          =  new Documents();
            
                    $leads_files->name = $lead_file_name;

                    // $leads_files->original_name = $file[$i]->getClientOriginalName();

                    $leads_files->file_type = $file[$i]->getClientOriginalExtension();
                    
                    $leads_files->url = url("storage/app/orders_files/order_{$lead_id}");
                    
                    $leads_files->created_at = date('Y-m-d');
        
                    $leads_files->save();
                    
                    $leads_documents = new OrderDocuments();
                
                
                    $leads_docs_array = ['document_id' =>$leads_files->id,'sale_order_id'=>$lead_id]; 
        
                    $leads_documents->create($leads_docs_array);
                    
                }
            
            }
            
            if($change_status == true){

                $statuses = new Status();

                $statuses->type = 'task';
               
                $statuses->title = 'New';
              
                $statuses->order = $lead_id;
    
                $statuses->save(); 
            }
           

            $data = [

                'success' => true, 

                'message'=>'Order Updated Successfully'

            ];
        }
        
        return response($data, 200)->header('Content-Type', 'text/plain');
    }


}
