<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderMessageDocuments extends Model
{
    use HasFactory;
    protected $table    = 'order_message_documents';
    protected $id       = 'id';
    protected $fillable = ['*'];
}
