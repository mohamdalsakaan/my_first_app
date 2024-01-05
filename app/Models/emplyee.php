<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class   emplyee extends Model
{
    use HasFactory;
    protected $table='emplyee';
    protected $fillable=[
        'contract_id',
        'name',
        'gender',
        'age',

    ];
    public function employee(){
        return $this->belongsTo('contract','contract_id');
    }
}
