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
        return Datatables::of($data)->editColumn('status',function($row){

                return '<label class="switch">
                <input type="checkbox" class="status_check_box "  data-set="'.$row->id.'" '.($row->status == 'ACTIVE' ? 'checked' : '').'>
                <span class="slider round"></span>
              </label>';

        })->addIndexColumn()->addColumn('action', function($row){
            $btn = "";
            if (Auth::user()->can('user-edit')):
                $btn .= "<a href='".route('user.edit',$row->id)."' class='btn btn-primary'>Edit</a>&nbsp;";
            endif;
            
            if (Auth::user()->can('user-delete')):
                $btn .= "<form action='".route('user.delete',$row->id)."'><button class='btn btn-danger' name='archive' type='submit' onclick='userDelete()'>Delete</button></form>";
            endif;
            return $btn;
        })->rawColumns(['action','status'])->make(true);
    }

}