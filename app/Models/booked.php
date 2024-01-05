<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class booked extends Model
{
    use HasFactory;

    protected $table='bookedd';
    protected $fillable=[
        'profile_user_id',
        'table_id',
        'date',
        're_mang_sys_id',
        'time_booked'

    ];

    public function booked(){
        return $this->belongsTo('profile_user','user_id');

    }
    public function table(){
        return $this->belongsTo('table','table_id');
    }

    public function re_mang_sys(){
        return $this->belongsTo('re_mang_sys','re_mang_sys_id');
    }

    // public function time_booked(){
    //     return $this->hasMany('time_booked','booked_id');

    // }


}
