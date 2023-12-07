<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'uid',
        'name',
        'result',
        'reward_type',
        'reward_content',
    ];
}