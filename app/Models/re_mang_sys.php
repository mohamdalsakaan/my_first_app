<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class re_mang_sys extends Model
{
    use HasFactory;
    protected $table='re_mang_sys';
    protected $fillable=[
        'name',
        'description',
        'date',
        'owner_id',
    ];
    public function re_mang_sys(){
        return $this->belongsTo('profile_owner','owner_id');
    }
    public function re_table(){
        return $this->hasMany('table','re_mang_sys_id');
    }

    public function main_category(){
        return $this->hasMany('main_category','re_mang_sys_id');
    }

    public function event2(){
        return $this->hasMany('event','re_mang_sys_id');
    }

    public function booked(){
        return $this->hasMany('booked','re_mang_sys_id');
    }

    public function order(){
        return $this->hasMany('order','re_mang_sys_id');
    }

    public function sub_place(){
        return $this->hasMany('sub_place','re_mang_sys_id');
    }
    public function fav_re(){
        return $this->hasMany('fav_re','favourity_id');
    }

    public function re_evaa(){
        return $this->hasMany('evaluation_re','re_mang_sys_id');
    }
}
