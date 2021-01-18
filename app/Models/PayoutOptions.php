<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayoutOptions extends Model
{
    use HasFactory;

    protected $table = 'payout_options';

    public function payout()
    {
        return $this->hasMany(Payouts::class);
    }
}
