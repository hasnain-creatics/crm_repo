<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternalNotifications extends Model
{
    use HasFactory;
    protected $table="internal_notifications";
    protected $id = 'id';
    protected $fillable = ['*'];

    public function notifications_users(){
        return $this->hasMany(NotificationUsers::class,'notification_id','id');
    }



}
