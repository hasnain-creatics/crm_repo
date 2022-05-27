<?php
namespace App\Datatables;
use Illuminate\Support\Facades\DB;
use DataTables;
// use Illuminate\Support\Facades\Gate;
use Auth;
use Carbon\Carbon;
use App\Models\User; 
use App\Models\Status;
use App\Models\OrderAssigns;
use App\Models\Orders;

class GlobalDatatables
{
    public $data;
    public $actions;
    public function __construct($data,$actions){
        $this->data = $data;
        $this->actions = $actions;
    }
    public function context()
    {
        $actions = $this->actions;
        return $this->{$actions}($this->data);
    }

    protected function users($data)
    {     
        return Datatables::of($data)
        
        ->editColumn('name',function($row){

            if($row->is_lead){

                return "<span  class='lead_id' onClick='check_team(".$row->id.")' >".$row->name."</span>";

            }else{

                return "<span>".$row->name."</span>";

            }

        })
        ->editColumn('profile_image',function($row){

            if($row->profile_image){

                return '<img src="'.url('storage/app/'.$row->profile_image).'" style="width:50px;">';

            }else{

                return '<img src="'.url("public/assets/images/no_image.jpg").'" style="width:50px;">';
       
            }

        })
        ->editColumn('status',function($row){

            return '<label class="switch">
                <input type="checkbox" class="status_check_box "  data-set="'.$row->id.'" '.($row->status == 'ACTIVE' ? 'checked' : '').'>
                <span class="slider round"></span>
              </label>';

        })->addIndexColumn()->addColumn('action', function($row){

            $btn = "<form action='".route('user.delete',$row->id)."' class='delete_submit'>";

            if (Auth::user()->can('user-edit')):

                $btn .= "<a href='".route('user.edit',$row->id)."' class='fa fa-edit' aria-hidden='true' title='Edit'></a>&nbsp;";

            endif;
            
            if (Auth::user()->can('user-delete')):

                $btn .= "&nbsp;&nbsp;<i class='fa fa-trash' aria-hidden='true' onclick='userDelete(".$row->id.")' style='cursor:pointer' title='Delete'></i>";

            endif;


                $btn .= "&nbsp;&nbsp;<i class='fa fa-eye' aria-hidden='true' onclick='userView(".$row->id.")' style='cursor:pointer' title='View'></i>";

            $btn.="</form>";

            return $btn;
        })->rawColumns(['action','profile_image','status','name'])->make(true);
    }

    public function leads($data){

        return Datatables::of($data)->editColumn('lead_id',function($row){

            return "<span  class='lead_id ".strtolower($row->id)."'  onClick='convertLead(".$row->id.")'>".$row->lead_id."</span>";

        })->editColumn('created_at',function($row){

            return date("d M Y H:i:s", strtotime($row->created_at));

        })->editColumn('lead_status',function($row){

            return "<span  class='lead_status ".strtolower($row->lead_status)."'  >".$row->lead_status."</span>";

        })->editColumn('issue',function($row){

            if($row->issue){
                
                return $row->issue;

            }else{

                return 'N/A';

            }

        })->addIndexColumn()->addColumn('action', function($row){

            $btn = "<form action='".route('leads.delete',$row->id)."' class='delete_submit'>";

            if (Auth::user()->can('leads-edit')):

                $btn .= "<a href='".route('leads.edit',$row->id)."' class='fa fa-edit' aria-hidden='true' title='Edit'></a>&nbsp;";

            endif;
           
            $btn .= "&nbsp;&nbsp;<i class='fa fa-files-o' aria-hidden='true' onclick='leadDocs(".$row->id.")' style='cursor:pointer' title='Documents'></i>";

            if(Auth::user()->roles[0]->name == 'Admin' || Auth::user()->roles[0]->type == 'manager' || Auth::user()->is_lead){
          
            if (Auth::user()->can('leads-transfer')):

                $btn .= "&nbsp;&nbsp;<i class='fa fa-exchange' aria-hidden='true' onclick='transferLead(".$row->id.")' style='cursor:pointer' title='Transfer Lead'></i>";
            
            endif;
           
                $btn .= "&nbsp;&nbsp;<i class='fa fa-info-circle' aria-hidden='true' onclick='transferLeadDetails(".$row->id.")' style='cursor:pointer' title='Lead Details'></i>";

            }

            return $btn;
            
        })->rawColumns(['action','lead_status','lead_id','issue','created_at'])->make(true);
    }

    public function orders($data){

        return Datatables::of($data)->editColumn('created_at',function($row){

                // return Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at)->format('D M Y H:i:s');
                return date("d M Y H:i:s", strtotime($row->created_at));
                
        })->editColumn('order_status',function($row){

            return (isset($row->order_status) ? $row->order_status->title : '');

        })->editColumn('deadline',function($row){

            // return Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at)->format('D M Y H:i:s');
            return date("d M Y H:i:s", strtotime($row->deadline));
            
          })->addIndexColumn()->addColumn('action', function($row){

            $btn = "";

            if (Auth::user()->can('orders-edit')):

                $btn .= "<a href='".route('orders.edit',$row->id)."' class='fa fa-edit' aria-hidden='true' title='Edit'></a>&nbsp;";

            endif;
       
            // $btn .= "&nbsp;&nbsp;<i class='fa fa-files-o' aria-hidden='true' onclick='leadDocs(".$row->id.")' style='cursor:pointer' title='Documents'></i>";

            if(Auth::user()->roles[0]->name == 'Admin' || Auth::user()->roles[0]->type == 'manager' || Auth::user()->is_lead){

                // $btn .= "&nbsp;&nbsp;<i class='fa fa-exchange' aria-hidden='true' onclick='transferLead(".$row->id.")' style='cursor:pointer' title='Transfer Lead'></i>";

                // $btn .= "&nbsp;&nbsp;<i class='fa fa-info-circle' aria-hidden='true' onclick='transferLeadDetails(".$row->id.")' style='cursor:pointer' title='Lead Details'></i>";

            }
            
            $btn .= "&nbsp;&nbsp;<i class='fa fa-info-circle' aria-hidden='true' onclick='OrderProgress(".$row->id.")' style='cursor:pointer' title='Order Runtime Progress'></i>";
            
            return $btn;
            
        })->rawColumns(['action','created_at','deadline','order_status'])->make(true);
    }

    public function writers($data){

        // $status = ["New","In Progress","Completed","Feedback","Qa In Progress","Rejected","Qa Approved","Delivered"];
        $status[] = "New";
        $status[] = "Pending";
        $status[] = "In Progress";

        $status[] = "Completed";
        // $status[] = "Feedback";
        $status[] = "Qa In Progress";
        $status[] = "Rejected";
        $status[] = "Qa Approved";
        // $status[] = "Delivered";
            $all_writers = User::select('users.id',
                        DB::raw('CONCAT(users.first_name," ",users.last_name) AS name'),'users.is_lead','users.lead_id')
                        ->whereHas('roles', function($q){
                            $q->whereIn('roles.name', ['Writer']);
            })->withCount(['order_assigns'=>function($query){
                $query->where('order_assigns.status_id', '!=', 'Completed');
                $query->where('order_assigns.status_id', '!=', 'Revoke');
                $query->where('order_assigns.status_id', '!=', 'Deleted');
            }])->get();
        return Datatables::of($data)->editColumn('order_status',function($row) use ($status){

            $html = "";

            $order_status = Status::where('order',$row->id)->orderBy('id','desc')->take(1)->first();
                           
            $html .="<select class='form-select status_type_".$row->id."' onChange='change_order_status(this,".$row->id.")'>";
                        
            foreach($status as $key=>$value){

                    if($order_status){
                    
                        $html .="<option ".($order_status->title == $value ? 'selected' : '').">".$value."</option>";
                
                    }
            }

            $html .="</select>";

            return $html;

          })->editColumn('order_assigns',function($row){

                return $row->order_assigns;

          })->editColumn('assign_to',function($row) use ($all_writers){

         
            $html = "";

            $html .="<select class='form-select'  onChange='assign_writer(this,".$row->id.")'>";

            $html .="<option ''></option>";

            foreach($all_writers as $key=>$value){

                // $count_orders_tasks = OrderAssigns::where('user_id',$value->user_id)->where('status_id','!=','Completed')->count();
                $html .="<option value=".$value->id.">".$value->name."(".$value->order_assigns_count.")</option>";
          
            }

            $html .="</select>";

            return $html;

          })->editColumn('deadline',function($row){

            // return Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at)->format('D M Y H:i:s');
            return date("D M Y H:i:s", strtotime($row->deadline));
            
          })->editColumn('documents',function($row){

            // // return Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at)->format('D M Y H:i:s');
            return 'documents';
            // Orders::sale_order_documents()
            // 
            
          })->addIndexColumn()->addColumn('action', function($row){

            $btn = "";
            $btn .= "<a href='".route('writers.task_details',$row->id)."' class='fa fa-edit' aria-hidden='true' title='Edit'></a>&nbsp;";

            // if (Auth::user()->can('orders-edit')):

            //     $btn .= "<a href='".route('orders.edit',$row->id)."' class='fa fa-edit' aria-hidden='true' title='Edit'></a>&nbsp;";

            // endif;
       
            // $btn .= "&nbsp;&nbsp;<i class='fa fa-files-o' aria-hidden='true' onclick='leadDocs(".$row->id.")' style='cursor:pointer' title='Documents'></i>";

            // if(Auth::user()->roles[0]->name == 'Admin' || Auth::user()->roles[0]->type == 'manager' || Auth::user()->is_lead){

                // $btn .= "&nbsp;&nbsp;<i class='fa fa-exchange' aria-hidden='true' onclick='transferLead(".$row->id.")' style='cursor:pointer' title='Transfer Lead'></i>";

                // $btn .= "&nbsp;&nbsp;<i class='fa fa-info-circle' aria-hidden='true' onclick='transferLeadDetails(".$row->id.")' style='cursor:pointer' title='Lead Details'></i>";

            // }
            
            return $btn;
            
        })->rawColumns(['action','created_at','deadline','order_status','documents','assign_to','order_assigns'])->make(true);
    }
}