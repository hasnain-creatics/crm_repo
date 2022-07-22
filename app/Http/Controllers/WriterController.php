<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Writer;
use App\Models\Orders;
use App\Models\Status;
use App\Models\OrderAssigns;
use App\Models\User;
use Auth;
use DB;
use Validator;
use App\Models\UserOrderTaskDetails;
use App\Models\Documents;
use App\Models\Sale_Order_Documents as OrderDocuments;
use Illuminate\Support\Facades\Artisan;
use App\Models\UserRatings;
use App\Models\Notifications;
use File;
class WriterController extends Controller
{

    
    public function __construct(){

        $this->middleware('permission:tasks-view', ['only' => ['index','task_details']]);
         
        // $this->middleware('permission:orders-edit', ['only' => ['edit','update']]);
        
        // $this->middleware('permission:orders-delete', ['only' => ['destroy']]);

        // $this->middleware('permission:orders-view', ['only' => ['index']]);
         
    }
    // ->where('document_name','!=',NULL)
    public function fetch_order($id=null,Orders $order){

        $user_id =  Auth::user()->id;

        $result = $order->with(['subjects',

                                'order_statuses'=>function($query){
                                    $query->select('statuses.order','statuses.title','statuses.id as status_status_id',
                                                    'users.id as status_user_id',
                                                    'users.first_name as status_first_name',
                                                    'users.last_name as status_last_name','statuses.created_at');
                                    $query->leftJoin('users','statuses.created_by','users.id');
                                    // $query->select('statuses.created_by','statuses.id','statuses.order');
                                    $query->orderBy('statuses.id','desc');

                                },

                                'sale_order_uploaded_document'=>function($query){

                                        $query->select('sale_order_documents.sale_order_id',

                                        'sale_order_documents.document_name',

                                        'sale_order_documents.doc_status',

                                        'sale_order_documents.id as sale_document_id',

                                        'sale_order_documents.created_by as created_by',
                                        
                                        'documents.id',

                                        'documents.name',
                                        
                                        'documents.url',

                                        'documents.file_type',

                                        'documents.original_name',

                                        'documents.created_at',

                                        'users.first_name',

                                        'users.last_name'
                                    );
                                    $query->where('sale_order_documents.document_name','!=',NULL);

                                    $query->join('documents','documents.id','=','sale_order_documents.document_id');

                                    $query->leftJoin('users','users.id','=','sale_order_documents.created_by');

                                    $query->orderBy('sale_order_documents.id','desc');

                                },

                                'sale_order_documents'=>function($query){

                                        $query->select('sale_order_documents.sale_order_id',

                                                        'documents.id',

                                                        'documents.name',
                                                        
                                                        'documents.url',

                                                        'documents.file_type',

                                                        'documents.original_name'

                                                    );

                                                    $query->where('sale_order_documents.document_name','=',NULL);
                                                    $query->where('documents.name','!=','order invoices');
                                                    $query->join('documents','documents.id','=','sale_order_documents.document_id');
                                }]);

                                if(Auth::user()->roles[0]->type == 'web' || Auth::user()->roles[0]->type === 'manager' || Auth::user()->is_lead == 1 || Auth::user()->roles[0]->name == 'sale manager'  || Auth::user()->roles[0]->name == 'sale agent'){

                                    $result = $result->with('order_assigns',function($query) use ($user_id){

                                        $query->join('users','order_assigns.user_id','users.id');

                                        $query->select('users.first_name',
                                                        'users.last_name',
                                                        'order_assigns.sale_order_id',
                                                        'order_assigns.user_id',
                                                        'order_assigns.status_id',
                                                        'order_assigns.created_at',
                                                        'order_assigns.id as assign_id',
                                                        'order_assigns.completed'
                                          
                                                    );

                                    });
                        
                                }else{
                                    
                                    $result = $result->with('order_assigns',function($query) use ($user_id){

                                        $query->join('users','order_assigns.user_id','users.id');

                                        $query->where('users.id',$user_id);
                                    
                                        $query->select('users.first_name',
                                                        'users.last_name',
                                                        'order_assigns.sale_order_id',
                                                        'order_assigns.user_id',
                                                        'order_assigns.status_id',
                                                        'order_assigns.created_at',
                                                        'order_assigns.id as assign_id',  
                                                        'order_assigns.completed'                                                    
                                                    );

                                    });
                        
                                }
                              
                                $result = $result->find($id);

                                $lead_manager_admin = false;

                                if(Auth::user()->roles[0]->type == 'web' || Auth::user()->roles[0]->type === 'manager' || Auth::user()->is_lead == 1){

                                   $lead_manager_admin     = true;
                        
                                }else{
                                    
                                   $lead_manager_admin     = false;
                        
                                }

                                $is_qa = false;

                                if(Auth::user()->is_qa == 1){

                                    $is_qa    = true;
                        
                                }else{
                                    
                                    $is_qa       = false;
                        
                                }

        $data = [

            'data' => [],

            'deadline' => "",

            'success' => false, 

            'message'=>'Order not found Successfully',

            'lead_manager_admin'=>$lead_manager_admin,

            'is_qa' =>$is_qa
        ];

        if($result){

            
            $data = [

                'data' => $result,

                'deadline' =>date('Y-m-d\TH:i', strtotime($result->deadline)),
                
                'success' => true, 
    
                'message'=>'Order found Successfully',

                'lead_manager_admin'=>$lead_manager_admin,
                
                'is_qa' =>$is_qa
            ];

        }
    
        return response()->json($data);

    }

    public function task_details_update($request,$id){

        $order_assign = new OrderAssigns(); 
        $text = "User ";

        $user_order_task_details = new UserOrderTaskDetails();

        $order_assign_update = $order_assign->where([
                                                        'user_id'=>$request->user_id,
                                                    
                                                        'sale_order_id'=>$id
                                                    
                                                    ])->first();

        $check_is_qa = true;

        $data['status'] = 'success';

        $data['message'] = 'user task updated successfully';

        $data['status_id'] = $request->status;
        
        if($request->status == 'QA Approved'){

            if(Auth::user()->is_qa != 1){
                
                $check_is_qa = false;
                
                $data['status'] = 'error';

                $data['message'] = 'Something went wrong';

                $data['status_id'] = $order_assign_update->status_id;

            }
                                    
        }
        if(isset($request->status) && $check_is_qa){

            $text.="Status changed {$request->status}, ";

            $user_order_task_details->status = $request->status;

            $order_assign_update->status_id = $request->status;

        }

        if(isset($request->completed)){

            $completed = (int)$request->completed;

            if(!empty($request->completed) && $completed <=100 && $request->completed >= 0){

                $text.="Progress updated {$request->completed}%, ";

                $user_order_task_details->completed = $request->completed;
            }

            $order_assign_update->completed =   $completed;

        }

        $user_order_task_details->order_id = $id;

        $user_order_task_details->user_id = $request->user_id;

        $user_order_task_details->text = $text;
        
        $user_order_task_details->created_by = Auth::user()->id;

        // $user_order_task_details->save();
        $this->save_notification($user_order_task_details,'user_task_status_changed');

        $order_assign_update->save();

        // $this->save_notification($order_assign_update,'user_task_status_changed');
        
    // $order_assign->user_id = Auth::user()->id;

    // $order_assign->sale_order_id = $id;

    // $status = new Status;

    // $count_status_already = $status->where(['order'=>$id])->orderBy('id','desc')->take(1)->first();

    // $order_assign->status_id = 'Pending';

    // $order_assign->save();
    return response()->json($data);
    }

    public function user_task_details_update(Request $request,$id){

        $this->task_details_update($request,$id);
        
    }


    public function writers_assiged_lists($id,OrderAssigns $order_assign){
        
        $check_order_status = new Orders();

        $data['order_status'] = $check_order_status->find($id)->order_status;

        $order_assign =  $order_assign->where('order_assigns.status_id','!=','Completed');
        
        $order_assign =  $order_assign->join('users','order_assigns.user_id','users.id');
        
        $order_assign =  $order_assign->where('order_assigns.sale_order_id',$id);

        $order_assign =  $order_assign->select('users.first_name',
                                                'users.last_name',
                                                'order_assigns.id as order_assign_id',
                                                'order_assigns.status_id',
                                                'order_assigns.created_at',
                                                'order_assigns.user_id',
                                                'order_assigns.completed');

        $order_assigned = $order_assign->get(); 
        
        $data['status'] = 'success';

        $data['id'] = $id;

        $data['result'] = $order_assigned;

        $data['users'] = User::select('users.id',DB::raw('CONCAT(first_name," ",last_name) AS name','is_lead','lead_id'),)
        ->whereHas('roles', function($q){
            $q->whereIn('name', ['Writer','Writer Manager']);
            })->withCount(['order_assigns'=>function($query){
                $query->where('order_assigns.status_id', '!=', 'QA Approved');
                $query->where('order_assigns.status_id', '!=', 'Completed');
                $query->where('order_assigns.status_id', '!=', 'Revoke');
                $query->where('order_assigns.status_id', '!=', 'Deleted');
            }])->get();
            

            if(Auth::user()->roles[0]->type == 'web' || Auth::user()->roles[0]->type === 'manager' || Auth::user()->is_lead == 1){

                $data['lead_manager_admin']     = true;
    
            }else{
                
                $data['lead_manager_admin']     = false;
    
            }


        return view('modals.writers.user_tasks',$data);

    }

    public function fetch_all_writers(){
        $writers = User::select('users.id',DB::raw('CONCAT(users.first_name," ",users.last_name) AS name','users.is_lead','users.lead_id'),)
        ->whereHas('roles', function($q){
            $q->whereIn('name', ['Writer','Writer Manager']);
            })->withCount(['order_assigns'=>function($query){
                $query->where('order_assigns.status_id', '!=', 'QA Approved');
                $query->where('order_assigns.status_id', '!=', 'Completed');
                $query->where('order_assigns.status_id', '!=', 'Delivered');
                   }])->get();
            
            return response()->json($writers);
    }

    public function submit_ratings(Request $request){
        $user_ratings = new UserRatings();
        $check_ratings = $user_ratings->where([
            'user_id'=>$request->user_id,
            'order_id'=>$request->order_id
        ])->first();
            
        if(isset($request->rating)){
            $ratings = $request->rating;
        }else{
            $ratings = 0;
        }
        if($check_ratings){

                $check_ratings->user_id     = $request->user_id;
                $check_ratings->order_id    = $request->order_id;
                $check_ratings->rating      = json_encode($ratings);
                $check_ratings->updated_by  = Auth::user()->id;

                $this->save_notification($check_ratings,'user_ratings_update');

                return response()->json([
                    'status'=>'success',
                    'message'=>'Ratings saved successfully',
                ]);

        }else{

                $user_ratings->user_id      = $request->user_id;
                $user_ratings->order_id     = $request->order_id;
                $user_ratings->rating       = json_encode($ratings);
                $user_ratings->created_at   = date('Y-m-d H:i:s');
                $user_ratings->updated_at   = date('Y-m-d H:i:s');
                $user_ratings->created_by   = Auth::user()->id;

                $this->save_notification($user_ratings,'user_ratings_add');

                return response()->json([
                    'status'=>'success',
                    'message'=>'Ratings saved successfully',
                ]);     
        }

      
        // if($save_ratings){
        //     return response()->json([
        //         'status'=>'success',
        //         'message'=>'Ratings saved successfully',
        //     ]);
        // }



    }

    public function delete_doc($id){

        $documents          =  new Documents();

        $order_documents    = new OrderDocuments();

        $check_document = $documents->find($id);

        $document_path  = explode('storage/',$check_document->url)[1];

        if(File::exists(storage_path($document_path))){

            File::delete(storage_path($document_path));

        }

        $documents->find($id)->delete();

        $order_documents->where('document_id',$id)->delete();

        return response()->json(['status'=>'success','message'=>'document delete sucess']);
        
    }


    public function delete_assigned_user(Request $request,OrderAssigns $order_assign){

        $order_assign->find($request->order_id)->delete();

        return response()->json(['status'=>'success','message'=>'task deleted successfully']);
        
    }

    public function check_user_assignments(Request $request,$id,OrderAssigns $order_assign){
    
        $order_assign= $order_assign->where('user_id',$request->user_id);

        $order_assign=  $order_assign->where('status_id','!=','Delivered')
                                        ->where('status_id','!=','QA Approved');

        $order_assigned = $order_assign->get(); 
        
        $data['total_pening_task'] = 0;
        
        $data['status'] = 'success';

        $data['message'] = 'No pending tasks';

        $count_tasks = count($order_assigned);

        if($count_tasks>0){
            
            $data['message'] = 'This user already '.$count_tasks.' task in pending';

            $data['total_pening_task'] = $count_tasks;

        }


        // check_user_assignments

        return response()->json($data);

    }

    public function assigned_user(Request $request,$id,OrderAssigns $order_assign){

        $order_assign->user_id = $request->user_id;

        $order_assign->sale_order_id = $id;

        $status = new Status;

        // $count_status_already = $status->where(['order'=>$id])->orderBy('id','desc')->take(1)->get();
        
        $check_order_assign = $order_assign->where(['user_id'=>$request->user_id,'sale_order_id'=>$id])->count();

        if($check_order_assign<=0){
            
            $order_assign->status_id = 'Pending';

            $order_assign->created_by = Auth::user()->id;

            $this->save_notification($order_assign,'task_assigned');

            $status->type = 'task';

            $status->title = 'Pending';

            $status->created_by = Auth::user()->id;

            $status->order = $id;

            $orders = new Orders();

            $update_order_status = $orders->find($id);
            
                if($update_order_status->order_status == 'New'){
                    
                $update_order_status->order_status = 'Pending';

                $update_order_status->updated_at = date('Y-m-d H:i:s');
                
                $update_order_status->save();

                $status->save();

            }

            // $notifications = 

        }

        $data['status'] = 'success';

        $data['message'] = 'task assigned successfully';

        return response()->json($data);

    }

    public function task_status_update(Request $request, $id){

        $ready_to_qa = true;  

        $order_documents = new OrderDocuments();

        $statuses = new Status();

        $check_already_status = $statuses->where('order',$id)->orderBy('id','desc')->take('1')->get();
        
        if(isset($request->title)){

            $title = $request->title;

        }
        
        // else{

        //     $title = $check_already_status[0]->title;

        // }
        
       
        $order = new OrderAssigns();
      
        $order_assign = new OrderAssigns();

        $order_assignments = $order_assign->where('sale_order_id',$id)->get();

        $ratings = true;

        if(in_array($request->title, ['Ready to QA'])){

            if(count($order_assignments)>=1){

                foreach($order_assignments as $keyy=>$valueese){

                    if($valueese->status_id != 'Ready to QA'){

                     $ready_to_qa = false;

                    }
                
                }
            }

        }else


        if(in_array($request->title, ['QA Approved'])){

            if(count($order_assignments)>=1){

                foreach($order_assignments as $keyy=>$valueese){

                    if($valueese->status_id != 'QA Approved'){

                        $ready_to_qa = false;

                    }

                    $user_ratings = new UserRatings();

                    $check_ratings = $user_ratings->where([

                                                            'user_id'=>$valueese->user_id,
                                                            'order_id'=>$valueese->sale_order_id

                                                        ])->first();
                    
                    if(!$check_ratings && $ratings == true){
                            
                        $ratings = false;

                    }
                
                }
            }
        }

        $data['status'] = 'success';

        $data['alert_message'] = 'Congratulations';

        $data['stop_reload'] = false;

        $data['message'] = ['your task updated successfully'];

        // if($check_already_status[0]->title != $title){
       
            $count_users = count($order_assignments);

            if($count_users == 1){
                
                $ready_to_qa = true;
                $object = new \stdClass(); 
                $object->user_id = $order_assignments[0]->user_id;
                $object->status = $title;
                if($title != 'Document Sending'){
                    $this->task_details_update($object,$id);    
                }
                
            }


            if($ready_to_qa == true){

                                 
            
                if($ratings == false){

                    $data['status'] = 'error';
    
                    $data['alert_message'] = 'Alert';
            
                    $data['stop_reload'] = false;
            
                    $data['message'] = ['Please before approve the task submit the ratings under assign user card.'];
            
                    return response()->json($data);
    
                }

                if($title == "QA Approved" || $title == 'Document Sending'){

                    $order_documents->whereIn('id', $request->select_files)->update([
                                                                                    'doc_status'=>'Sent',
                                                                                    'updated_at'=>date('Y-m-d H:i:s')]);
                     
                 }
    

                $statuses->type = 'task';
       
                $statuses->title = $request->title;
              
                $statuses->order = $id;

                $statuses->created_by = Auth::user()->id;
                
                $orders = new Orders;
                
                $update_order_status = $orders->find($id);

                $update_order_status->order_status = $request->title;

                if($title != 'Document Sending'){
                    
                    $update_order_status->save();
                    
                    $this->save_notification($statuses,'order_status_change');
                }
                
                            
            }else{
                
                $data['status'] = 'error';
                $data['title'] = $check_already_status[0]->title;

                $data['alert_message'] = 'Alert';

                $data['stop_reload'] = true;

                $data['message'] = ['task status can not be change because some users is still working on it.'];

            }
        
        // }

        return response()->json($data);
    }


    public function task_update(Request $request, $id){



        $rules['files'] = 'required';

        $rules['name'] = 'required';

        $validator = Validator::make( $request->all(), $rules);

        if ( $validator->fails() ) 
        {


            $data = [
                'success' => false, 
                'message'=>$validator->errors(),
                'result'=>[],
            ];

            return  $data;

    }else{

        if ($request->file('files')) {
                
            $statuses = new Status();

            $check_already_status = $statuses->where('order',$id)->orderBy('id','desc')->take('1')->get();
            
            if(isset($request->title)){

                $title = $request->title;

            }else{

                $title = $check_already_status[0]->title;

            }

            if($title == 'Ready to QA'){

                $order = new Orders();
                
                $result = $order->with(['subjects',

                    'order_statuses'=>function($query){

                        $query->orderBy('statuses.id','desc');

                    },

                ]);
       
                $result = $result->with('order_assigns',function($query){

                    $query->join('users','order_assigns.user_id','users.id');

                    $query->select('users.first_name',
                                  'users.last_name',
                                  'order_assigns.sale_order_id',
                                  'order_assigns.user_id',
                                  'order_assigns.status_id',
                                  'order_assigns.created_at',
                                  'order_assigns.id as assign_id',
                                  'order_assigns.completed'
                                );

                    });
        
                $check_orders_assignments = $result->find($id);

          
                    
            }
            $data['status'] = 'success';

            $data['alert_message'] = 'Congratulations';

            $data['stop_reload'] = false;

            $data['message'] = ['your documents uploaded successfully'];

            $file = $request->file('files');

            for($i=0;$i<count($file);$i++){
                
                // $lead_file_name = 'task-data-'.date('YmdHis').'.'.$file[$i]->getClientOriginalExtension();
                $lead_file_name = $file[$i]->getClientOriginalName();

                $original_file_name = $file[$i]->getClientOriginalExtension();

                $task_folder = date('YmsHis');

                $path = $file[$i]->storeAs("task_files/order_{$id}/{$task_folder}", $lead_file_name);
        
                $leads_files          =  new Documents();
        
                $leads_files->name = 'task uploaded document';

                $leads_files->file_type = $file[$i]->getClientOriginalExtension();
                
                $leads_files->url = url("storage/app/task_files/order_{$id}/{$task_folder}/{$lead_file_name}");
                
                $leads_files->created_at = date('Y-m-d H:i:s');

                $leads_files->original_name = $file[$i]->getClientOriginalName();
    
                $leads_files->save();
                
                $leads_documents = new OrderDocuments();
          
                if(Auth::user()->roles[0]->name == 'Sale Manager' || Auth::user()->roles['0']->name == 'Sale Agent'){
              
                    $leads_documents->doc_status = 'Sale Docs';

                }

                $leads_documents->document_name = $request->name;
                $leads_documents->document_id = $leads_files->id;
                $leads_documents->sale_order_id = $id;
                $leads_documents->created_by = Auth::user()->id;
                $leads_documents->save();
                
            }

            $notifications       = new \App\Models\InternalNotifications();
           
            $created_at = date('d M Y H:i:s', strtotime(date('Y-m-d H:i:s')));

            $notifications->data   =    json_encode([
                                            "message"=>"{$this->full_name(Auth::user()->id)}, New document add on ORDER-{$id}",
                                            "url"=>url("admin/writers/task_details/{$id}")
                                        ]);

            $notifications->save();

            $ids = $this->send_all_writers_managers($notifications, Auth::user()->id);
            
            $this->alert_notify(null,null,$ids);

            return response()->json($data);
           
        }


    }

    }

    public function change_status(Request $request,Status $status,$id){

            $status->type = 'task';
        
            $status->title = $request->title;
            
            $status->order = $id;
        
            $status->save();
    
            $data['status'] = 'success';
            
            $data['message'] = 'status updated successfully';
    
            $data['id'] = $id;
       
            $data['order_status'] = $request->title;
        
            return response()->json($data);
     

    }

    public function task_details($id){

        $task_details = [];
        
        return view('writers.task_details',compact('task_details','id'));

    }

    public function index(Request $request)
    {   
        $user_show_new_table = true;
        
        if ($request->ajax()) {
                            
                           $data = new Orders();

                           $data = $data->select('sale_orders.*')->with(['order_assigns']);

                            if(isset($_GET['order_id']) && !empty($_GET['order_id'])){
    
                                $order_id = $_GET['order_id']; 
                
                                $data = $data->where('sale_orders.order_id',$_GET['order_id']);     
                        
                            }

                            // if(isset($_GET['customer_email'])&& !empty($_GET['customer_email'])){
    
                            //     $customer_email = $_GET['customer_email']; 
                
                            //     $data = $data->where('sale_orders.customer_email',$_GET['customer_email']);     
                        
                            // }

                            if(isset($_GET['deadline'])&& !empty($_GET['deadline'])){
    
                                $status = $_GET['deadline']; 
                
                                $data = $data->whereDate('sale_orders.deadline',$_GET['deadline']);     
                        
                            }
                                if($this->is_admin() != true){

                                    if(Auth::user()->roles[0]->type != 'manager'){


                                    }else{
                                        
                                        if(Auth::user()->is_lead){

                                            $data = $data->orWhere('users.lead_id',Auth::user()->id);
                        
                                        }
                                    }
                                
                                }
         
                                if(isset($_GET['new_tab']) && !empty($_GET['new_tab'])){
                              
                                    $data = $data->whereNotIn('sale_orders.id',OrderAssigns::select('sale_order_id')
                                                                    ->get()
                                                                    ->toArray())->where('sale_orders.order_status','=','New');
                                                  $data = $data->orderBy('sale_orders.id','DESC');    
                                    
                    
                                }
                                if(isset($_GET['all_tab']) && !empty($_GET['all_tab'])){

                                  if(Auth::user()->roles[0]->type == 'web' || Auth::user()->roles[0]->type === 'manager' || Auth::user()->is_lead == 1){

                                    $data = $data->whereIn('sale_orders.id',OrderAssigns::select('sale_order_id')->get()->toArray());

                                  }  else{

                                      $data = $data->whereIn('sale_orders.id',OrderAssigns::select('sale_order_id')->where('user_id',Auth::user()->id)->get()->toArray());

                                  }
                            
                                  $data = $data->orderBy('sale_orders.updated_at','DESC');          
                            
                                }
                                
                return $this->table($data,'writers');   
            
        }
        if(Auth::user()->roles[0]->type == 'web' || Auth::user()->roles[0]->type === 'manager' || Auth::user()->is_lead == 1){

            $user_show_new_table = true;

        }else{
            
            $user_show_new_table = false;

        }
            
       return view('writers.index',compact('user_show_new_table'));

    }

    public function user_ratings($user_id,$order_id){
        
        $user_ratings = new UserRatings();
        $result = $user_ratings->where(['user_id'=>$user_id,'order_id'=>$order_id])->first();
        $data['status'] = 'error';
        $data['message'] = 'ratings not found successfully';
        $data['result'] = [];
        if(isset($result)){
            $data['status'] = 'success';
            $data['message'] ='data found successfully';
            $data['result'] = json_decode($result->rating);
        }
        return response()->json($data);

    }



}
