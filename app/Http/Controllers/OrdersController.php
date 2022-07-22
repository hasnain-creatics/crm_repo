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
use App\Mail\OrderMail;
use App\Models\Sale_Order_Failed;
use App\Models\OrderFeedback;
use App\Models\OrderFeedbackDocuments;
use Illuminate\Support\Facades\Mail;
use App\Notifications\OrderPlaced;
use Illuminate\Support\Facades\Notification;
use Illuminate\Contracts\Mail\Mailable;
class OrdersController extends Controller
{

    public function __construct(){

        $this->middleware('permission:orders-add', ['only' => ['create','update']]);
         
        $this->middleware('permission:orders-edit', ['only' => ['edit','update']]);
        
        $this->middleware('permission:orders-delete', ['only' => ['destroy']]);

        $this->middleware('permission:orders-view', ['only' => ['index']]);
         
    }

    public function fetch_all_feedback($id){
        
        $order_feedback = new OrderFeedback();

        $order_feedback = $order_feedback->with([
                                                'orders',
                                                'users',
                                                'feedback_documents']);

        $order_feedback = $order_feedback->where('order_id',$id);

        $order_feedback = $order_feedback->get();

        $data['result'] = $order_feedback;
        
        return response()->json($data);

    }

    public function add_feedback($id){

        $data['id'] = $id;

     

        return view('modals.orders.add_feedback',$data);

    }
    public function store_feedback(Request $request){

        if(!empty($request->feedback)){

            $order_feedback = new OrderFeedback();

            $order_feedback->order_id = $request->order_id;
            if($request->deadline){
                $order_feedback->deadline = $request->deadline;
            }
            

            $order_feedback->created_by = Auth::user()->id;

            $order_feedback->feedback = $request->feedback;

            // $save_feedback = $order_feedback->save();
                // echo 'here';die;
            $save_feedback = $this->save_notification($order_feedback,'order_feedback_added');
            
            if($request->deadline){
            
                $orders = new Orders();

                $find_order_ = $orders->find($request->order_id);

                $find_order_->deadline = $request->deadline;

                $find_order_->save();

            }

            if ($request->file('files')) {
                
                $file = $request->file('files');
    
                for($i=0;$i<count($file);$i++){
    
                    $file_name = $file[$i]->getClientOriginalName();
    
                    $path = $file[$i]->storeAs("order_feedback_documents/order_{$request->order_id}", $file_name);

                  $order_feedback_documents = new OrderFeedbackDocuments();

                   $order_feedback_documents->file_name = $file_name;

                   $order_feedback_documents->link = $path;

                   $order_feedback_documents->created_by = Auth::user()->id;

                   $order_feedback_documents->feedback_id =$order_feedback->id;

                   $order_feedback_documents->save();

                }
            
            }
        }
        
        return response()->json(['status'=>'success','feedback added successfully','order_id'=>$request->order_id]);
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
                            if($_GET['status'] == 'failed'){

                                $data = $data->where('sale_orders.order_status','Failed');

                            }
                            if($_GET['status'] == 'completed'){

                                $data = $data->where('sale_orders.order_status','Completed');

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

    public function update_payment_status(Request $request,$id){

        $orders = new Orders();

        $order_find = $orders->find($id);

        $order_find->amount_received = $request->payment;

        $order_find->payment_status = 'PAID';

        $order_find->save();

        $data['status'] = 'success';
        
        $data['message'] = 'order payment updated successfully';

        $data['id'] = $id;
    
        return response()->json($data);

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

    public function delete_doc(Orders $order,$id){
        $delete = DB::table('documents')->where('id',$id)->delete();
        return response()->json(['status'=>'success','message'=>'document delete successfully','id'=>$id]);
    }

    public function all_docs(Orders $order,$id){

        $result = $order->with([

                                'sale_order_documents'=>function($query){

                                        $query->select('sale_order_documents.sale_order_id',
                                                        'sale_order_documents.id as  sale_order_document_id',
                                                        'documents.id',

                                                        'documents.name',
                                                        
                                                        'documents.url',

                                                        'documents.file_type',

                                                        'documents.original_name'

                                                    );

                                                    $query->where('sale_order_documents.document_name','=',NULL);
                       
                                                    $query->join('documents','documents.id','=','sale_order_documents.document_id');
                                }]);

                                $results = $result->find($id);
                                
                                $data['status']= 'success';
                                $data['all_docs'] = [];
                                $data['id'] = $id;
                                
                                if($results->sale_order_documents){
                                    $data['status']= 'success';
                                    $data['all_docs'] = $results->sale_order_documents;
                                }


                                return view('modals.orders.order_documents',$data);

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

                                // $data = $data->orWhere('sale_orders.created_by_user_id',Auth::user()->id);

                                $data = $data->orWhere('users.assigned_to',Auth::user()->id);

                            }
                            else{
                                
                                if(Auth::user()->is_lead){
                                    // $data = $data->orWhere('sale_orders.created_by_user_id',Auth::user()->id);
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
        
        $result = $order->with('currency')->find($id);
        
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


    public function failed_reason(Request $request,$id){

        $order_failed = new Sale_Order_Failed();
        $data['status'] = 'success';
        $data['message'] = 'reason addess successfully';
        $data['title'] = 'Failed';
        if(!empty(trim($request->reason))){

            $order_failed->reason = $request->reason;

            $order_failed->order_id = $id;

            $order_failed->created_by = Auth::user()->id;

            $order_failed->save();

            if ($request->file('files')) {
                
                $file = $request->file('files');
    
                for($i=0;$i<count($file);$i++){
    
                    $lead_file_name = 'order-data-'.date('YmdHis').'.'.$file[$i]->getClientOriginalExtension();
    
                    $original_file_name = $file[$i]->getClientOriginalExtension();
    
                    $path = $file[$i]->storeAs("orders_files/order_{$id}", $lead_file_name);
            
                    $leads_files          =  new Documents();
            
                    $leads_files->name = 'failed files';
    
                    // $leads_files->original_name = $file[$i]->getClientOriginalName();
    
                    $leads_files->file_type = $file[$i]->getClientOriginalExtension();
                    
                    $leads_files->url = url("storage/app/orders_files/failed_files/order_{$id}/{$lead_file_name}");
                    
                    $leads_files->created_at = date('Y-m-d');
        
                    $leads_files->save();
                    
                    $leads_documents = new OrderDocuments();
              
                    $leads_docs_array = ['document_id' =>$leads_files->id,'document_name'=>'failed document by sale user','sale_order_id'=>$id,'doc_status'=>'Failed']; 
        
                    $leads_documents->create($leads_docs_array);
                    
                }
            
            }
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

        $rules['customer_type']  = 'required';

        $rules['title']          = 'required';

        $rules['word_count'] = 'required';

        $rules['subject_id'] = 'required';

        $rules['deadline'] = 'required';

        $rules['payment_status'] = 'required';

        $rules['currency_id'] = 'required';

        $rules['amount'] = 'required';

        $rules['notes'] = 'required';

        $rules['additional_notes'] = '';

        $rules['website'] = 'required';

        $rules['lead_id'] = '';
        
        $rules['dollar_amount'] ='required';

        // $rules['issue'] = null;

        // $rules['reason'] = null;
        

        if($request->payment_status == 'UNPAID'){

            $rules['issue'] ='required';

            if($request->issue == 'other'){

                $rules['reason'] ='required';

            }
        }

       
        $change_status = true;

        if($request->payment_status == 'PARTIALLY PAID'){

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
            
            if(!$request->id && !$request->file('invoice_files')){

               return  $data = [

                    'success' => false, 

                    'message'=>['invoice_files'=>'Invoice files field required']

                ];
   
            }
           
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
            
                if(isset($request->id)){
            
                }else{

                    $order_updated['order_status'] = 'New';

                }

                if($request->payment_status == 'PAID'){

                    $order_updated['amount_received'] = $request->dollar_amount;

                }
                
            }
        

            if(isset($request->id)){

                // $this->save_notification($order_updated,'order_updated');
                $order_updated->save();

            }else{

                $this->save_notification($order_updated,'new_order_added');

            }
            

            $lead_id = $order_updated->id;

            $find_lead_id = $leads->find($lead_id);

            $find_lead_id->order_id = "ORDER-{$lead_id}";
            
            $find_lead_id->save();

            if ($request->file('files')) {
                
                $file = $request->file('files');

                for($i=0;$i<count($file);$i++){

                    $lead_file_name = $file[$i]->getClientOriginalName();
                    // $lead_file_name = 'order-data-'.date('YmdHis').'.'.$file[$i]->getClientOriginalExtension();

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

                    // $lead_file_name = 'order-invoice-data-'.date('YmdHis').'.'.$file[$i]->getClientOriginalExtension();

                    $lead_file_name = $file[$i]->getClientOriginalName();

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
                
                if($request->id){

                }else{
                    
                    // Notification::route('mail', $request->customer_email)->notify(new OrderPlaced('ORDER-'.$lead_id));
                                        
                }


            }
           

            $data = [

                'success' => true, 

                'message'=>'Order Updated Successfully'

            ];
        }
        
        return response($data, 200)->header('Content-Type', 'text/plain');
    }
    
    public function order_upsell(Request $request,$id){
    
        if($request->segment(5)){

            $data['upsell'] = 'upsell';
            
        }

        $data['id'] = $id;

        if(isset($upsell)){

            $data['upsell']= $upsell;

        }

        return view('orders.edit',$data);

    }

    public function order_full_details($id){
            
        $task_details = [];
        
        $order = new Orders();
        
        $check_order_status = $order->find($id);

        if($check_order_status->order_status !='QA Approved' && 
           $check_order_status->order_status !='Delivered' && 
           $check_order_status->order_status !='Completed' 
           ){
        
            return redirect(route('delivery.index'))->with('message', 'Only writers can see this order details');
        
        }


        return view('writers.task_details',compact('task_details','id'));


    }

    public function order_status_details($id,Orders $order){
        
                                $result = $order->with(['order_statuses'=>function($query){
                                    $query->select('statuses.order','statuses.title','statuses.id as status_status_id',
                                                    'users.id as status_user_id',
                                                    'users.first_name as status_first_name',
                                                    'users.last_name as status_last_name','statuses.created_at');
                                    $query->leftJoin('users','statuses.created_by','users.id');
                                    // $query->select('statuses.created_by','statuses.id','statuses.order');
                                    $query->orderBy('statuses.id','desc');

                                },
                                ]);

                                $result = $result->find($id);
                                return view('modals.orders.order_status_details',compact('result','id'));


    }

    public function destroy($id){
        $orders = new Orders();
        $orders->find($id)->delete();
        return response()->json(['status'=>'success','message'=>'Order deleted successfully!']);
    }
}
