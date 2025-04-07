<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Claimed extends Model
{
    use HasFactory;

    protected $table = 'claimed';

    protected $fillable = ['user_id', 'amount', 'claimed_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
