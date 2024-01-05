<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sub_place extends Model
{
    use HasFactory;
    protected $table='sub_place';
    protected $fillable=[
        're_mang_sys_id',
        'description',
        'name_country',
        'name_city',
        'name_region',
        'name_street'
    ];
    public function sub_place(){
        return $this->belongsTo('re_mang_sys','re_mang_sys_id');
    }

}
