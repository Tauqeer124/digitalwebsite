<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wallet extends Model
{
    protected $fillable = [
      'user_id',
      'total_balance',
      'description',
      'points_reward',
      'withdraw_amount',
    ];
    use HasFactory;
    public function user()
{
    return $this->belongsTo(User::class);
}

}
