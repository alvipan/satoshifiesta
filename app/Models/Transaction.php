<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'uid',
        'ipn_id',
        'trx_id',
        'type',
        'currency',
        'amount',
        'fee',
        'address',
        'status'
    ];
}
