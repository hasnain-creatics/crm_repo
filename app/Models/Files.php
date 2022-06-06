<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    use HasFactory;

    public function lead_documents(){
        return $this->hasMany(Lead_Document::class,'file_id');
    }
}
