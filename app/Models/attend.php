<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class attend extends Model
{
    use HasFactory;

    protected $table='attend';
    protected $fillable=[
        'profile_user_id',
        'event_id',

    ];

    public function event(){
        return $this->belongsTo('event','event_id');
    }
    public function user(){
        return $this->belongsTo('profile_user','profile_user_id');
    }


}
