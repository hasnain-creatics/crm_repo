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
use App\Models\UserRatings;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        //  $this->middleware('permission:dashboard-view', ['only' => ['index']]);
    
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        if(Auth::user()->roles[0]->type == 'web' || Auth::user()->roles[0]->type === 'manager' || Auth::user()->is_lead == 1){

            $result['lead_manager_admin']     = true;

        }else{
            
            $result['lead_manager_admin']     = false;

        }
        
        $users = new User();
        
        $result['user_rating'] = round(collect($users->where('id',Auth::user()->id)
                                                     ->with('user_ratings')
                                                     ->first()
                                                     ->user_ratings
                                                     )->avg('rating'));
        return view('dashboard.index',$result);
    }

    public function task_details($unassigned=null){

        $data = new Orders();

        $data = $data->select('sale_orders.*')->with(['order_status','order_assigns']);
        if(!isset($unassigned)){
            if(Auth::user()->roles[0]->type == 'web' || Auth::user()->roles[0]->type == 'manager' || Auth::user()->is_lead == 1){
    
                $data = $data->whereIn('sale_orders.id',OrderAssigns::select('sale_order_id')->get()->toArray());
            }  
            else
            {
                $data = $data->whereIn('sale_orders.id',OrderAssigns::select('sale_order_id')
                             ->where('user_id',Auth::user()->id)
                             ->get()->toArray());
            }
        } 
        return $data;

    }

    public function writer_urgent_tasks(){

       $data = $this->task_details()->where('sale_orders.order_status','!=','Completed')->where('sale_orders.is_urgent',1);

       $data = $data->paginate(4);

       return response()->json($data);

    }



    public function writer_new_tasks(){

        $data = $this->task_details()->where('sale_orders.order_status','Pending');
 
        $data = $data->paginate(4);
 
        return response()->json($data);
 
     }


     public function writer_unassigned_tasks(){
 
         $data = $this->task_details('unassigned')->where('sale_orders.order_status','New')->orWhere('sale_orders.order_status',NULL);
  
         $data = $data->paginate(4);
  
         return response()->json($data);
  
      }
 
 
     public function inprogress_task(){

        $data = $this->task_details()->where('sale_orders.order_status','In progress');
 
        $data = $data->paginate(4);
 
        return response()->json($data);
 
     }
 
     public function qa_required_task(){
 
        $data = $this->task_details()->where('sale_orders.order_status','Ready to QA');
 
        $data = $data->paginate(4);
 
        return response()->json($data);
  
     }

 
     public function writer_feedback_tasks(){

        $data = $this->task_details()->where('sale_orders.order_status','Feedback');
 
        $data = $data->paginate(4);
 
        return response()->json($data);
    }

     public function writer_dashboard_counters(){

        $task = $this->task_details();

        $result['urgent_count'] = $task->where('sale_orders.order_status','!=','Completed')->where('sale_orders.is_urgent',1)->count();
        
        $result['new_count']    = $task->where('sale_orders.order_status','Pending')->count();

        $result['unassigned']    = $this->task_details('unassigned')->where('sale_orders.order_status','New')->orWhere('sale_orders.order_status',NULL)->count();

        $result['in_progress']  = $task->where('sale_orders.order_status','In Progress')->count();

        $result['feedback']     = $task->where('sale_orders.order_status','Feedback')->count();

        $result['ready_to_qa']     = $this->task_details('ready to qa')->where('sale_orders.order_status','Ready to QA')->count();
       
        if(Auth::user()->roles[0]->type == 'web' || Auth::user()->roles[0]->type === 'manager' || Auth::user()->is_lead == 1){

            $result['lead_manager_admin']     = true;

        }else{
            
            $result['lead_manager_admin']     = false;

        }
        return response()->json($result);

     }

    public function writer_dashboard_counters1(){

        $data = $this->task_details()->get();

        $collection = collect($data);

        $result['data'] = $data;

        $new_orders = collect([]);

        $user_urgent_tasks = collect([]);
        
        $collection->each(function ($item) use($new_orders,$user_urgent_tasks) {
        
            $urgent_order_id = "";
        
            if($item->is_urgent == 1){
        
                $urgent_order_id = $item->id;
        
            }

            collect($item->order_assigns)->each(function($valuee) use ($new_orders,$urgent_order_id,$user_urgent_tasks){

                if($valuee->user_id == Auth::user()->id){
                        
                    $new_orders->push(['status'=>$valuee->status_id]);

                    if($valuee->sale_order_id == $urgent_order_id){

                        $user_urgent_tasks->push(['urgent'=>$valuee->sale_order_id]);

                    }
                }


            
            });
          
        });

        $result['urgent_count'] = $user_urgent_tasks->count();
        
        $result['new_count'] = $new_orders->where('status','Pending')->count();

        $result['in_progress'] = $new_orders->where('status','In Progress')->count();

        return response()->json($result);

    }



}
