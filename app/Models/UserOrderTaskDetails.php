<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOrderTaskDetails extends Model
{
    
    use HasFactory;
    
    protected $table = 'user_order_task_details';
    
    protected $id = 'id';
    
    protected $fillable = ['*'];

}
