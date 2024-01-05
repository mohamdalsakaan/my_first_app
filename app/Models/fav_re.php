<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fav_re extends Model
{
    use HasFactory;
    protected $table='fav_re';
    protected $fillable=[
   'favourity_id',
   're_mang_sys_id'
    ];
    public function re(){
        return $this->belongsTo('re_mang_sys','re_mang_sys_id');
    }
    public function fav_re(){
        return $this->belongsTo('favourity','favourity_id');
    }
}
