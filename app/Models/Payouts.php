<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payouts extends Model
{
    use HasFactory;

    protected $table = 'payouts';

    public function payoutOption()
    {
        return $this->belongsTo(PayoutOptions::class, 'pid');
    }
}
