<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class table extends Model
{
    use HasFactory;
    protected $table='tables';
    protected $fillable=[
        'num_chairs',
    ];


    public function booked(){
        return $this->hasMany('booked','table_id');
    }

}
