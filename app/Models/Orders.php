<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $table = "sale_orders";
    protected $guarded = ['id'];
    protected $fillable = ['*'];



    public function status(){

        return $this->hasOne(Status::class,'order')->orderBy('id','desc');

    }
    
    public function order_status(){

        return $this->hasOne(Status::class,'order')->orderBy('id','desc');

    }

    public function sale_order_documents(){

        return $this->hasMany(Sale_Order_Documents::class,'sale_order_id');

    }

    public function order_assigns(){

        return $this->hasMany(OrderAssigns::class,'sale_order_id');

    }
    
    public function subjects(){
        return $this->hasOne(Subjects::class,'id','subject_id');
    }
}
