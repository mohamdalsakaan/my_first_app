<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class event extends Model
{
    use HasFactory;
    protected $table='event';
    protected $fillable=[
        'date',
        'num_attenders',
        'artist',
        'price',
        're_mang_sys_id',
        'name',
        'description'

    ];
    public function event(){
        return $this->belongsTo('re_mang_sys','re_mang_sys_id');
    }

    public function attend(){
        return $this->hasMany('attend','event_id');
    }
     public function fav_event(){
        return $this->hasMany('fav_event','event_id');
     }
}
