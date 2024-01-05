<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fav_sub extends Model
{
    use HasFactory;
    protected $table='fav_sub';
    protected $fillable=[
        'favourity_id',
        'sub_category_id'
    ];
    public function fav_sub(){
        return $this->belongsTo('favourity','favourity_id');
    }
    public function sub(){
        return $this->belongsTo('sub_category','sub_category_id');
    }

}
