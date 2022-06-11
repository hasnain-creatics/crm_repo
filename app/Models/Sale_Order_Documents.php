<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use League\CommonMark\Node\Block\Document;

class Sale_Order_Documents extends Model
{
    use HasFactory;

    protected $table = 'sale_order_documents';
    protected $id = 'id';
    protected $fillable =['document_id','sale_order_id','document_name','created_by','created_at','doc_status'];

    // public function lead_documents(){
    //     return $this->hasMany(Lead_Document::class,'file_id');
    // }

    public function documents(){

        return $this->hasMany(Documents::class);
        
    }
}
