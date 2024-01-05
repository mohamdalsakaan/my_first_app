<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profile_owner extends Model
{
    use HasFactory;
    protected $table='profile_owner';
    protected $fillable=[
        'image',
        'name',
        'email',
        'password',
        'owner_id'
    ];
    public function owner(){
        return $this->belongsTo('User','owner_id');
    }
    public function re_mang_sys(){
        return $this->hasOne('re_mang_sys','owner_id');
    }
    public function contra(){
        return $this->hasMany('contract','owner_id');
    }
}
