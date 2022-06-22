<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderMessage extends Model
{
    use HasFactory;
    protected $id = 'id';
    protected $table = 'order_messages';

    public function users(){
        return $this->hasOne(User::class,'id','sender_id');
    }
    public function order_message_documents(){
        return $this->hasMany(OrderMessageDocuments::class,'order_message_id');
    }
}
