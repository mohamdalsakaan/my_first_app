<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class main_category extends Model
{
    use HasFactory;
    protected $table='main_category';
    protected $fillable=[
        'name',
        'image',
        're_mang_sys_id',
    ];
    public function main_category(){
        return $this->belongsTo('re_mang_sys','re_mang_sys_id');
    }

    public function main2(){
        return $this->hasMany('sub_category','main_category_id');
    }
}
