<?php
namespace App\Datatables;
use Illuminate\Support\Facades\DB;
use DataTables;
// use Illuminate\Support\Facades\Gate;
use Auth;

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

}