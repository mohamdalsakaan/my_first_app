<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order_sub extends Model
{
    use HasFactory;
  protected $table='order_sub';
  protected $fillable=[
    'sub_cate_id',
    'order_id',
    'amount'
  ];
  public function sub_cate(){
    return $this->belongsTo('sub_category','sub_cate_id');
  }
  public function order(){
    return $this->belongsTo('order','order_id');
  }

  public function invoice(){
    return $this->hasOne('invoice','order_sub_id');
  }


}
