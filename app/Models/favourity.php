<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class favourity extends Model
{
    use HasFactory;
    protected $table='favourity';
    protected $fillable=[
        'profile_user_id',
    ];
    public function favourity(){
        return $this->belongsTo('profile_user','profile_user_id');
    }
    public function fav_sub(){
        return $this->hasMany('fav_sub','fav_sub_id');
    }
    public function re_mang(){
        return $this->hasMany('re_mang_sys','re_mang_sys_id');
    }
    public function event(){
        return $this->hasMany('event','event_id');
    }
}


