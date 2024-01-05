<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fav_event extends Model
{
    use HasFactory;
    protected $table='fav_event';
    protected $fillable=[
        'favourity_id',
        'event_id'
    ];
    public function fav_event(){
        return $this->belongsTo('favourity','favourity_id');
    }
    public function event(){
        return $this->belongsTo('event','event_id');
    }
}
