<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale_Order_Subjects extends Model
{
    use HasFactory;

    protected $table = 'sale_order_subjects';
    protected $id = 'id';
    protected $fillable =['*'];

   
}
