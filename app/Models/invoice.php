<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{
    use HasFactory;
    protected $table='invoicee';
    protected $fillable=[
        'order_id',
        'price_all',
        'date',
    ];
    public function invoice(){
        return $this->belongsTo('order_sub','order_sub_id');
    }
}
