<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sub_category extends Model
{
    use HasFactory;
    protected $table='sub_category';
    protected $fillable=[
        'name',
        'price',
        'image',
        'description',
        'main_category_id',

    ];
    public function sub_category(){
        return $this->belongsTo('main_category','main_category_id');
    }
    public function invoice(){
        return $this->belongsTo('invoice','main_category_id');
    }

    public function sub(){
        return $this->hasMany('order_sub','sub_cate_id');
    }
    public function fav_sub(){
        return $this->hasMany('fav_sub','fav_sub_id');
    }

}
