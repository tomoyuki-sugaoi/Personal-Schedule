<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PmSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'day',
        'time',
        'schedule',
    ];
}
