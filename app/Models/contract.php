<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contract extends Model
{
    use HasFactory;
    protected $table='contract';
    protected $fillable=[
        'profile_owner_id',
        'sallary',
        'date_contract',
        'opening_date',
    ];
    public function contract(){
        return $this->belongsTo('profile_user','profile_user_id');
    }
    public function contra(){
        return $this->belongsTo('profile_owner','profile_owner_id');
    }
    public function employee(){
        return $this->hasOne('emplyee','contract_id');
    }

public function cont_user()
{
    return $this->hasMany(cont_user::class, 'contract_id');
}


}
