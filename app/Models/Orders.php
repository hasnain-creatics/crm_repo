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

       
    public function order_statuses(){

        return $this->hasMany(Status::class,'order');

    }

    public function sale_order_documents(){

        return $this->hasMany(Sale_Order_Documents::class,'sale_order_id');

    }
    public function sale_order_uploaded_document(){

        return $this->hasMany(Sale_Order_Documents::class,'sale_order_id');

    }

    public function order_assigns(){

        return $this->hasMany(OrderAssigns::class,'sale_order_id','id');

    }
    
    public function subjects(){

        return $this->hasOne(Subjects::class,'id','subject_id');
        
    }

    public function user(){

        return $this->hasOne(User::class,'id','created_by_user_id');
        
    }

    public function currency(){
        return $this->belongsTo(Currency::class,'currency_id','id');
    }

    public function user_ratings(){
        return $this->belongsTo(UserRatings::class,'order_id','id');
    }
}
