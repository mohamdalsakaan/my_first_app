<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profile_user extends Model
{
    use HasFactory;
    protected $table='profile_user';
    protected $fillable=[
    'image',
    'name',
    'email',
    'password',
    'budget',
    'user_id'
    ];

    public function user(){
        return $this->belongsTo('User','user_id');

    }
    public function invoice(){
        return $this->hasOne('invoice','user_id');
    }
    public function contract(){
        return $this->hasOne('contract','user_id');
    }

    public function order(){
        return $this->hasMany('order','profile_user_id');
    }

    public function booked(){
        return $this->hasMany('booked','user_id');
    }

    public function attend(){
        return $this->hasOne('attend','profile_user_id');
    }



    public function cont_user()
{
    return $this->hasMany(cont_user::class, 'profile_user_id');
}
}
