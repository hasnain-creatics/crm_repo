<?php
namespace App\Datatables;
use Illuminate\Support\Facades\DB;
use DataTables;

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
        return Datatables::of($data)->addIndexColumn()->addColumn('action', function($row){
            $btn = "";
            $btn .= "<a href='".route('user.edit',$row->id)."' class='btn btn-primary'>Edit</a>&nbsp;";
            $btn .= "<form action='".route('user.delete',$row->id)."'>
                        <button class='btn btn-danger' name='archive' type='submit' onclick='userDelete()'>Delete</button></form>";
      
            return $btn;
        })->rawColumns(['action'])->make(true);
    }

}