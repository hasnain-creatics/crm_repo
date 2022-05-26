<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice_Board extends Model
{
    use HasFactory;
    protected $table = 'notices';
    protected $id = 'id';
}
