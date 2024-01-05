<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cont_user extends Model
{
    use HasFactory;
    protected $table = 'contract_user';
    protected $fillable = [
      'contract_id',
      'profile_user_id',
      'is_agree'
    ];

   /**
    * Get the user that owns the cont_user
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function contract()
   {
       return $this->belongsTo(contract::class, 'contract_id');
   }

   public function profile_user()
   {
       return $this->belongsTo(profile_user::class, 'profile_user_id');
   }
}
