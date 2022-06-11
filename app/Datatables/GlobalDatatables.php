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

        })->editColumn('url',function($row){

            if($row->website_url){
                return "<a href='".$row->website_url->name."'>".$row->website_url->name."</a>";
            }else{
                return "N/A";
            }

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
            
        })->rawColumns(['action','lead_status','lead_id','issue','created_at','url'])->make(true);
    }

    public function orders($data){

        return Datatables::of($data)->editColumn('created_at',function($row){


                return date("d M Y H:i:s", strtotime($row->created_at));
                
        })->editColumn('order_status',function($row){

            return (isset($row->order_status) ? $row->order_status : '');

        })->editColumn('deadline',function($row){


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
            
            // $btn .= "&nbsp;&nbsp;<i class='fa fa-info-circle' aria-hidden='true' onclick='OrderProgress(".$row->id.")' style='cursor:pointer' title='Order Runtime Progress'></i>";
            
            return $btn;
            
        })->rawColumns(['action','created_at','deadline','order_status'])->make(true);
    }


    public function ready_to_delivery($data){

        return Datatables::of($data)->editColumn('created_at',function($row){


                return date("d M Y H:i:s", strtotime($row->created_at));
                
        })->editColumn('order_status',function($row){

            return (isset($row->order_status) ? $row->order_status : '');

        })->editColumn('deadline',function($row){


            return date("d M Y H:i:s", strtotime($row->deadline));
            
          })->addIndexColumn()->addColumn('action', function($row){

            $btn = "";

            if (Auth::user()->can('orders-edit')):

                // $btn .= "<a href='".route('orders.edit',$row->id)."' class='fa fa-edit' aria-hidden='true' title='Edit'></a>&nbsp;";

            endif;
       
            // $btn .= "&nbsp;&nbsp;<i class='fa fa-files-o' aria-hidden='true' onclick='leadDocs(".$row->id.")' style='cursor:pointer' title='Documents'></i>";

            if(Auth::user()->roles[0]->name == 'Admin' || Auth::user()->roles[0]->type == 'manager' || Auth::user()->is_lead){

                // $btn .= "&nbsp;&nbsp;<i class='fa fa-exchange' aria-hidden='true' onclick='transferLead(".$row->id.")' style='cursor:pointer' title='Transfer Lead'></i>";

                // $btn .= "&nbsp;&nbsp;<i class='fa fa-info-circle' aria-hidden='true' onclick='transferLeadDetails(".$row->id.")' style='cursor:pointer' title='Lead Details'></i>";

            }
            if($row->order_status == "QA Approved"){

                $btn .="&nbsp; <i class='fa fa-truck' title='Fast Deliver Order' onclick='deliver_order(this,".$row->id.")' style='cursor:pointer;' aria-hidden='true' ></i>";

            }

            if($row->order_status == 'Delivered'){

                $btn .="&nbsp; <i class='fa fa-comments-o' title='Add Feedback' onclick='add_feedback(".$row->id.")' style='cursor:pointer;' aria-hidden='true' ></i>";

                $btn .="&nbsp; <i class='fa fa-exclamation-triangle' title='Failed' onclick='order_fail(".$row->id.")' style='cursor:pointer;' aria-hidden='true' ></i>";

            }
            
            $btn .= "&nbsp;&nbsp;<i class='fa fa-info-circle' aria-hidden='true' onclick='OrderFullDetails(".$row->id.")' style='cursor:pointer' title='Task Details'></i>";
            
            return $btn;
            
        })->rawColumns(['action','created_at','deadline','order_status'])->make(true);
    }

    public function writers($data){


            $all_writers = User::select('users.id',
                        DB::raw('CONCAT(users.first_name," ",users.last_name) AS name'),'users.is_lead','users.lead_id')
                        ->whereHas('roles', function($q){
                            $q->whereIn('roles.name', ['Writer']);
            })->withCount(['order_assigns'=>function($query){
                $query->where('order_assigns.status_id', '!=', 'Completed');
                $query->where('order_assigns.status_id', '!=', 'Revoke');
                $query->where('order_assigns.status_id', '!=', 'Deleted');
            }])->get();
        return Datatables::of($data)->editColumn('order_status',function($row){

            $html = "";
           
            if($row->order_status){
       
                $html .="<select disabled class='form-select status_type_".$row->id."' onChange='change_order_status(this,".$row->id.")'>";
            
                if($row->order_status == 'New'){

                    $html .="<option value='New'  selected >New</option>";

                }else{

                    $html .="<option value='New' >New</option>";

                }
                
                if($row->order_status == 'Pending'){

                    $html .="<option value='Pending' selected >Pending</option>";

                }else{


                    $html .="<option value='Pending' >Pending</option>";


                }
                
                if($row->order_status == 'In Progress'){

                   $html .="<option value='In Progress' selected >In Progress</option>";


                }else{

                    $html .="<option value='In Progress' >In Progress</option>";
                    
                }
                
                if($row->order_status == 'Ready to QA'){

                    $html .="<option value='Ready to QA' selected >Ready to QA</option>";

                }else{

                    $html .="<option value='Ready to QA'>Ready to QA</option>";

                }
                if(Auth::user()->roles[0]->type == 'web' || Auth::user()->roles[0]->type === 'manager' || Auth::user()->is_lead == 1){

                    if($row->order_status == 'QA Approved'){

                        $html .="<option value='QA Approved' selected >QA Approved</option>";

                    }else{

                        $html .="<option value='QA Approved' >QA Approved</option>";

                    }
                }
                   
                if($row->order_status == 'Feedback'){

                    $html .="<option value='Feedback' selected >Feedback</option>";

                }else{

                    $html .="<option value='Feedback'>Feedback</option>";

                }

                      
                if($row->order_status == 'Delivered'){

                    $html .="<option value='Delivered' selected >Delivered</option>";

                }else{

                    $html .="<option value='Delivered'>Delivered</option>";

                }

                if($row->order_status == 'Failed'){

                    $html .="<option value='Failed' selected >Failed</option>";

                }else{

                    $html .="<option value='Failed'>Failed</option>";

                }


                if($row->order_status == 'Completed'){

                    $html .="<option value='Completed' selected >Completed</option>";

                }else{

                    $html .="<option value='Completed'>Completed</option>";

                }



                $html .="</select>";

            }
             
            return $html;

          })->editColumn('order_assigns',function($row){

                return $row->order_assigns;

          })->editColumn('assign_to',function($row) use ($all_writers){
         
            $html = "";

            $html .="<select class='form-select'  onChange='assign_writer(this,".$row->id.")'>";

            $html .="<option ''></option>";

            foreach($all_writers as $key=>$value){
                
                $html .="<option value=".$value->id.">".$value->name."(".$value->order_assigns_count.")</option>";
          
            }

            $html .="</select>";

            return $html;

          })->editColumn('deadline',function($row){

            return date("D M Y H:i:s", strtotime($row->deadline));
            
          })->editColumn('documents',function($row){

            return 'documents';
         
            
          })->addIndexColumn()->addColumn('action', function($row){

            $btn = "";
            $btn .= "<a href='".route('writers.task_details',$row->id)."' class='fa fa-edit' aria-hidden='true' title='Edit'></a>&nbsp;";

            return $btn;
            
        })->rawColumns(['action','created_at','deadline','order_status','documents','assign_to','order_assigns'])->make(true);
    }
}