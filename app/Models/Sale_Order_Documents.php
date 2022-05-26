<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale_Order_Documents extends Model
{
    use HasFactory;

    protected $table = 'sale_order_documents';
    protected $id = 'id';
    protected $fillable =['document_id','sale_order_id'];

    // public function lead_documents(){
    //     return $this->hasMany(Lead_Document::class,'file_id');
    // }
}
