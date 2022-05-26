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
    

}
