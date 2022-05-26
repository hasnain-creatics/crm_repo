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
class WriterController extends Controller
{

    
    public function __construct(){

        $this->middleware('permission:tasks-view', ['only' => ['create','update']]);
         
        // $this->middleware('permission:orders-edit', ['only' => ['edit','update']]);
        
        // $this->middleware('permission:orders-delete', ['only' => ['destroy']]);

        // $this->middleware('permission:orders-view', ['only' => ['index']]);
         
    }
    public function all_tasks(){



    }

    public function new_tasks(){


    }


    public function writers_assiged_lists($id,OrderAssigns $order_assign){
    
        $order_assign =  $order_assign->where('order_assigns.status_id','!=','Completed');
        
        $order_assign =  $order_assign->join('users','order_assigns.user_id','users.id');
        
        $order_assign =  $order_assign->where('order_assigns.sale_order_id',$id);

        $order_assign =  $order_assign->select('users.first_name','users.last_name','order_assigns.status_id','order_assigns.created_at');

        $order_assigned = $order_assign->get(); 
        
        $data['status'] = 'success';

        $data['id'] = $id;

        $data['result'] = $order_assigned;

        $data['users'] = User::select('users.id',DB::raw('CONCAT(first_name," ",last_name) AS name','is_lead','lead_id'),)
        ->whereHas('roles', function($q){
            $q->whereIn('name', ['Writer','Writer Manager']);
            })->withCount(['order_assigns'=>function($query){
                $query->where('order_assigns.status_id', '!=', 'Completed');
                $query->where('order_assigns.status_id', '!=', 'Revoke');
                $query->where('order_assigns.status_id', '!=', 'Deleted');
            }])->get();


        return view('modals.writers.user_tasks',$data);

    }


    public function check_user_assignments(Request $request,$id,OrderAssigns $order_assign){
    
        $order_assign= $order_assign->where('user_id',$request->user_id);

        $order_assign=  $order_assign->where('status_id','!=','Completed');

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

        $count_status_already = $status->where(['order'=>$id])->orderBy('id','desc')->take(1)->first();

        $order_assign->status_id = 'In Progress';

        $order_assign->save();

        $status->type = 'task';

        $status->title = 'In Progress';

        $status->order = $id;;

        $status->save();

        $data['status'] = 'success';

        $data['message'] = 'task assigned successfully';

        return response()->json($data);



    }

    public function change_status(Request $request,Status $status,$id){

        $count_status_already = $status->where(['id'=>$id,'title'=>$request->title])->get();

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
  
    public function index(Request $request)
    {   $user_show_new_table = true;
        if ($request->ajax()) {
            $data = new Orders();

                           $data = $data->select('sale_orders.*','users.first_name','documents.url as doc_url')->with('status');

                            $data = $data->join('users','users.id','=','sale_orders.created_by_user_id');

                            $data = $data->leftJoin('sale_order_documents','sale_order_documents.sale_order_id','=','sale_orders.id');

                            $data = $data->leftJoin('documents','documents.id','=','sale_order_documents.document_id');

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
                            
                                  $data = $data->orderBy('sale_orders.id','ASC');          
                            
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
