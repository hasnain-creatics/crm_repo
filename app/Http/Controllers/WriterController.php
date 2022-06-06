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

                                    $query->orderBy('statuses.id','desc');

                                },

                                'sale_order_uploaded_document'=>function($query){

                                        $query->select('sale_order_documents.sale_order_id',

                                        'sale_order_documents.document_name',
                                        
                                        'documents.id',

                                        'documents.name',
                                        
                                        'documents.url',

                                        'documents.file_type'

                                    );
                                    $query->where('sale_order_documents.document_name','!=',NULL);

                                    $query->join('documents','documents.id','=','sale_order_documents.document_id');

                                    $query->orderBy('sale_order_documents.id','desc');

                                },
                                'sale_order_documents'=>function($query){

                                        $query->select('sale_order_documents.sale_order_id',

                                                        'documents.id',

                                                        'documents.name',
                                                        
                                                        'documents.url',

                                                        'documents.file_type'

                                                    );

                                                    $query->where('sale_order_documents.document_name','=',NULL);

                                                    $query->join('documents','documents.id','=','sale_order_documents.document_id');
                                }]);

                                if(Auth::user()->roles[0]->type == 'web' || Auth::user()->roles[0]->type === 'manager' || Auth::user()->is_lead == 1){

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

                                    $lead_manager_admin = true;
                        
                                }else{
                                    
                                    $lead_manager_admin = false;
                        
                                }

        $data = [

            'data' => [],

            'deadline' => "",

            'success' => false, 

            'message'=>'Order not found Successfully',

            'lead_manager_admin'=>$lead_manager_admin

        ];

        if($result){

            
            $data = [
                'data' => $result,

                'deadline' =>date('Y-m-d\TH:i', strtotime($result->deadline)),
                
                'success' => true, 
    
                'message'=>'Order found Successfully',

                'lead_manager_admin'=>$lead_manager_admin
            ];

        }
    
        return response()->json($data);

    }

    public function user_task_details_update(Request $request,$id,OrderAssigns $order_assign){
        
            $text = "User ";

            $user_order_task_details = new UserOrderTaskDetails();

            $order_assign_update = $order_assign->where([
                                                            'user_id'=>$request->user_id,
                                                        
                                                            'sale_order_id'=>$id
                                                        
                                                        ])->first();


            if(isset($request->status)){

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

            

            $user_order_task_details->save();

            $order_assign_update->save();
            
        // $order_assign->user_id = Auth::user()->id;

        // $order_assign->sale_order_id = $id;

        // $status = new Status;

        // $count_status_already = $status->where(['order'=>$id])->orderBy('id','desc')->take(1)->first();

        // $order_assign->status_id = 'Pending';

        // $order_assign->save();

    }


    public function writers_assiged_lists($id,OrderAssigns $order_assign){
    
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
        $writers = User::select('users.id',DB::raw('CONCAT(first_name," ",last_name) AS name','is_lead','lead_id'),)
        ->whereHas('roles', function($q){
            $q->whereIn('name', ['Writer','Writer Manager']);
            })->withCount(['order_assigns'=>function($query){
                $query->where('order_assigns.status_id', '!=', 'QA Approved');
                $query->where('order_assigns.status_id', '!=', 'Completed');
                $query->where('order_assigns.status_id', '!=', 'Revoke');
                $query->where('order_assigns.status_id', '!=', 'Deleted');
            }])->get();
            
            return response()->json($writers);
    }

    public function submit_ratings(Request $request){

        $check_ratings = DB::table('user_ratings')->where([
            'user_id'=>$request->user_id,
            'order_id'=>$request->order_id
        ])->get();
        
            if(isset($request->rating)){
                $ratings = $request->rating;
            }else{
                $ratings = 0;
            }
        if(count($check_ratings)>=1){
            $save_ratings = DB::table('user_ratings')->where([
                'user_id'=>$request->user_id,
                'order_id'=>$request->order_id
            ])->update([
                'user_id'=>$request->user_id,
                'order_id'=>$request->order_id,
                'rating'=>$ratings,
                'updated_at'=>date('Y-m-d H:i:s'),
                'updated_by'=>Auth::user()->id
            ]);
        }else{
            $save_ratings = DB::table('user_ratings')->insert([
                'user_id'=>$request->user_id,
                'order_id'=>$request->order_id,
                'rating'=>$ratings,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
                'created_by'=>Auth::user()->id
            ]);
        }

      
        if($save_ratings){
            return response()->json([
                'status'=>'success',
                'message'=>'Ratings saved successfully',
            ]);
        }

    }

    public function delete_assigned_user(Request $request,OrderAssigns $order_assign){

        $order_assign->find($request->order_id)->delete();

        return response()->json(['status'=>'success','message'=>'task deleted successfully']);
        
    }

    public function check_user_assignments(Request $request,$id,OrderAssigns $order_assign){
    
        $order_assign= $order_assign->where('user_id',$request->user_id);

        $order_assign=  $order_assign->where('status_id','!=','Completed')
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

            $order_assign->save();

            $status->type = 'task';

            $status->title = 'Pending';

            $status->order = $id;;

            $orders = new Orders();

            $update_order_status = $orders->find($id);

            $update_order_status->order_status = 'Pending';

            $update_order_status->updated_at = date('Y-m-d H:i:s');
            
            $update_order_status->save();

            $status->save();

        }

        $data['status'] = 'success';

        $data['message'] = 'task assigned successfully';

        return response()->json($data);

    }

    public function task_update(Request $request, $id){


            $rules['files'] = 'required';
            $rules['name'] = 'required';

            $ready_to_qa = true;   


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

          

                    foreach($check_orders_assignments->order_assigns as $keyy=>$valueese){

                        if($valueese->status_id != 'Ready to QA'){

                          $ready_to_qa = false;

                        }
                      
                    }
                    
            }
            $data['status'] = 'success';

            $data['alert_message'] = 'Congratulations';

            $data['stop_reload'] = false;

            $data['message'] = ['your documents uploaded successfully'];

            if($check_already_status[0]->title != $title){

                if($ready_to_qa == true){
                  
                    $statuses->type = 'task';
           
                    $statuses->title = $request->title;
                  
                    $statuses->order = $id;
                    
                    $orders = new Orders;
                    
                    $update_order_status = $orders->find($id);
    
                    $update_order_status->order_status = $request->title;
    
                    $update_order_status->save();
    
                    $statuses->save(); 

                

                }else{
                    $data['alert_message'] = 'Alert';

                    $data['stop_reload'] = true;

                    $data['message'] = ['your documents uploaded successfully but status can not updated b/c some assigned task still not ready to qa.'];

                }
            
            }

            $file = $request->file('files');

            for($i=0;$i<count($file);$i++){

                $lead_file_name = 'task-data-'.date('YmdHis').'.'.$file[$i]->getClientOriginalExtension();

                $original_file_name = $file[$i]->getClientOriginalExtension();

                $path = $file[$i]->storeAs("task_files/order_{$id}", $lead_file_name);
        
                $leads_files          =  new Documents();
        
                $leads_files->name = 'task uploaded document';

                $leads_files->file_type = $file[$i]->getClientOriginalExtension();
                
                $leads_files->url = url("storage/app/task_files/order_{$id}/{$lead_file_name}");
                
                $leads_files->created_at = date('Y-m-d');
    
                $leads_files->save();
                
                $leads_documents = new OrderDocuments();
          
                $leads_docs_array = ['document_name'=>$request->name,'document_id' =>$leads_files->id,'sale_order_id'=>$id]; 

                $leads_documents->create($leads_docs_array);
                
           
            }

            return response()->json($data);
            // return ['status'=>'success','message'=>'document saved successfully'];

        }


    }

    }

    public function change_status(Request $request,Status $status,$id){

        if(count($count_status_already)>0){

            $data['status'] = 'error';
            
            $data['message'] = 'this order already updated';
    
            $data['id'] = $id;
    
            $data['order_status'] = $request->title;
    
            return response()->json($data);

        }else{

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

                            if(isset($_GET['customer_email'])&& !empty($_GET['customer_email'])){
    
                                $customer_email = $_GET['customer_email']; 
                
                                $data = $data->where('sale_orders.customer_email',$_GET['customer_email']);     
                        
                            }

                            if(isset($_GET['payment_status'])&& !empty($_GET['payment_status'])){
    
                                $status = $_GET['payment_status']; 
                
                                $data = $data->where('sale_orders.payment_status',$_GET['payment_status']);     
                        
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
                              
                                    $data = $data->whereNotIn('sale_orders.id',OrderAssigns::select('sale_order_id')->get()->toArray());
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




}
