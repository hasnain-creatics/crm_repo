<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles,SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',"deleted_at"
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Add the below function
    public function messages()
    {
        return $this->hasMany(Message::class);
    }    

    public function city(){
      return $this->belongsTo(City::class,'city_id');
    }

    public function order_assigns(){
        return $this->hasMany(OrderAssigns::class,'user_id')->groupBy('user_id');
    }
    
    public function user_ratings(){
        return $this->hasMany(UserRatings::class,'user_id');
    }

    public function leads(){
        return $this->hasMany(Leads::class,'created_by')->groupBy('leads.created_by');
    }
}
