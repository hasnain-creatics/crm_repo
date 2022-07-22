<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadTransfered extends Model
{
    use HasFactory;
   
    protected $table = 'lead_transfers';
    
    protected $id = 'id';
    
    protected $fillable = ['*'];
}
