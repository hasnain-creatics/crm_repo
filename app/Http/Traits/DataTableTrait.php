<?php
namespace App\Http\Traits;
use App\Datatables\GlobalDatatables;
trait DataTableTrait 
{

    public function table($data,$actions)
    {
        return $this->tableData($data,$actions)->context();
    }

    protected function tableData($data,$actions) 
    {
        
        $class =  new GlobalDatatables($data,$actions);
        
        return $class;

    }

}