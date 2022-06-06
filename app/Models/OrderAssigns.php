<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAssigns extends Model
{
    use HasFactory;

    protected $table = 'order_assigns';
    protected $id = 'id';
    protected $fillable=['*'];

    public function user(){
        $this->belongsTo(User::class,'user_id');
    }
}
