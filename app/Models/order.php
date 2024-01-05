<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $table='order';
    protected $fillable=[
        'date',
        'profile_user_id',
        'table_id',
        're_mang_sys_id'
    ];
    public function profile_user(){
        return $this->belongsTo('profile_user','profile_user_id');
    }
    public function or(){
        return $this->hasMany('order_sub','order_id');
    }

    public function re_mang_sys(){
        return $this->belongsTo('re_mang_sys','re_mang_sys_id');
    }
}
