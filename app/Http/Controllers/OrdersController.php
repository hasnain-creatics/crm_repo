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

    public function add_feedback($id){

        $data['id'] = $id;
        return view('modals.orders.add_feedback',$data);

    }

    public function store_feedback(Request $request){
        if(!empty($request->feedback)){
            $save_feedback = DB::table('order_feedback')->insert([
                'order_id'=>$request->order_id,
                'created_by'=>Auth::user()->id,
                'created_at'=>date('Y-m-d H:i:s'),
                'feedback'=>$request->feedback

            ]);
            if($save_feedback){

                $orders = new Orders();

                $orders_update = $orders->find($request->order_id);

                $orders_update->order_status = 'Feedback';
                
                $orders_update->save();

                $statuses = new Status();

                $statuses->type = 'task';
               
                $statuses->title = 'Feedback';
              
                $statuses->order = $request->order_id;
    
                $statuses->save(); 
            }

        }
            
    }

    public function order_timline($id){
        $status = OrderAssigns::select('*')
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

    public function delivery(Request $request){
        if ($request->ajax()) {

            $data = new Orders();
    
            $data = $data->select('sale_orders.*','users.first_name')->with('order_status');
    
                            // $data = $data->leftJoin('lead_issues','lead_issues.id','=','leads.lead_issue_id');
    
                            $data = $data->join('users','users.id','=','sale_orders.created_by_user_id');
    
                            // $data = $data->leftJoin('lead_transfers lt','lt.lead_id','=','leads.id');
    

                            if($this->is_admin() != true){
    
                                // $data = $data->where('leads.transfered_id',Auth::user()->id);

                                if(Auth::user()->roles[0]->type == 'manager'){

                       
                                    $data = $data->orWhere('users.assigned_to',Auth::user()->id);

                                }
                                else{
                                    
                                    if(Auth::user()->is_lead){
                                      
                                        $data = $data->orWhere('users.lead_id',Auth::user()->id);
                     
                                    }
                                }
                              
                            }

                            if($_GET['status'] =='delivered'){

                                $data = $data->where('sale_orders.order_status','Delivered');

                            }

                            if($_GET['status'] == 'ready_to_delivered'){

                                $data = $data->where('sale_orders.order_status','QA Approved');

                            }
                            

                            if(isset($_GET['order_id']) && !empty($_GET['order_id'])){
       
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
    
                            if(isset($_GET['date_start'])&& !empty($_GET['date_start'])){
           
                                $date_start = $_GET['date_start'] ." 00:00:00";
                                
                                $data = $data->where('sale_orders.created_at','>=',$date_start);     
                        
                            }
    
                            if(isset($_GET['date_end'])&& !empty($_GET['date_end'])){
       
                                $date_end = $_GET['date_end'] ." 23:59:59";
                 
                                $data = $data->where('sale_orders.created_at','<=',$date_end);     
                        
                            }
    
                         

                      

                $data = $data->orderBy('sale_orders.id','DESC')->get();          
    
    
                return $this->table($data,'ready_to_delivery');   
            
        }
           return view('orders.delivery');
    }

    public function change_order_status(Request $request,$id){

        $status = new Status();
        
        $orders = new Orders();

        $status->type = 'task';
        
        $status->title = $request->status;
        
        $status->order = $id;
        
        $find_order = $orders->find($id);

        $find_order->order_status = $request->status;

        $find_order->save();

        $status->save();

        $data['status'] = 'success';
        
        $data['message'] = 'status updated successfully';

        $data['id'] = $id;
   
        $data['order_status'] = $request->title;
    
        return response()->json($data);
 

    }


    public function index(Request $request)
    {       
        if ($request->ajax()) {

        $data = new Orders();

        $data = $data->select('sale_orders.*','users.first_name')->with('order_status');

                        // $data = $data->leftJoin('lead_issues','lead_issues.id','=','leads.lead_issue_id');

                        $data = $data->join('users','users.id','=','sale_orders.created_by_user_id');

                        // $data = $data->leftJoin('lead_transfers lt','lt.lead_id','=','leads.id');
                        if($this->is_admin() != true){
                            
                            $data = $data->where('sale_orders.created_by_user_id',Auth::user()->id);
                 
                            if(Auth::user()->roles[0]->type == 'manager'){

                                $data = $data->orWhere('sale_orders.created_by_user_id',Auth::user()->id);

                                $data = $data->orWhere('users.assigned_to',Auth::user()->id);

                            }
                            else{
                                
                                if(Auth::user()->is_lead){
                                    $data = $data->orWhere('sale_orders.created_by_user_id',Auth::user()->id);
                                    $data = $data->orWhere('users.lead_id',Auth::user()->id);
                 
                                }
                            }
                          
                        }

                        if(isset($_GET['order_id']) && !empty($_GET['order_id'])){
   
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

                         
            $data = $data->orderBy('sale_orders.id','DESC')->get();          


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
              $order_updated['order_status'] = 'New';
                
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
            
                    $leads_files->name = 'order files';

                    // $leads_files->original_name = $file[$i]->getClientOriginalName();

                    $leads_files->file_type = $file[$i]->getClientOriginalExtension();
                    
                    $leads_files->url = url("storage/app/orders_files/order_{$lead_id}/{$lead_file_name}");
                    
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
            
                    $leads_files->name = 'order invoices';

                    // $leads_files->original_name = $file[$i]->getClientOriginalName();

                    $leads_files->file_type = $file[$i]->getClientOriginalExtension();
                    
                    $leads_files->url = url("storage/app/orders_files/order_{$lead_id}/{$lead_file_name}");
                    
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

                $statuses->created_by = Auth::user()->id;
    
                $statuses->save(); 
                
            }
           

            $data = [

                'success' => true, 

                'message'=>'Order Updated Successfully'

            ];
        }
        
        return response($data, 200)->header('Content-Type', 'text/plain');
    }

    public function order_full_details($id){
            
    
        $task_details = [];
        
        return view('writers.task_details',compact('task_details','id'));


    }

}
