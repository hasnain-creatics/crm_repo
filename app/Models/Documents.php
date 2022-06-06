<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    use HasFactory;
    protected $table = 'documents';
    // protected $fillable = ['file_id','lead_id'];

    // public function files(){

    //     return $this->belongsTo(Files::class,'file_id','id');

    // }
}
