<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class evaluation_re extends Model
{
    use HasFactory;
    protected $table='evaluation_re';
    protected $fillable=[
        'love',
        're_mang_sys_id'
    ];
    public function re_eva(){
        return $this->belongsTo('re_mang_sys','re_mang_sys_id');
    }
}
