<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRatings extends Model
{
    use HasFactory;
    protected $table = 'user_ratings';
    protected $id = 'id';
    protected $fillable=['*'];

    public function orders(){
        return $this->hasOne(Orders::class,'id','order_id')->select('order_id','id');
    }

  
}
