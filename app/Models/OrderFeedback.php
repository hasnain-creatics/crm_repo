<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderFeedback extends Model
{
    use HasFactory;
    protected $table = 'order_feedback';
    protected $id = 'id';
    protected $fillable = ['*'];

    public function orders(){
        return $this->hasOne(Orders::class,'id','order_id');
    }

    public function users(){
        return $this->hasOne(User::class,'id','created_by');
    }
    
    public function feedback_documents(){

        return $this->hasMany(OrderFeedbackDocuments::class,'feedback_id','id');

    }
}



