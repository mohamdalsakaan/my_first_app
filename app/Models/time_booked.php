<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class time_booked extends Model
{
    use HasFactory;

    protected $table='time_booked';
    protected $fillable=[
        'date'
    ];

    // public function time_booked(){
    //     return $this->belongsTo('booked','booked_id');

    // }
}
