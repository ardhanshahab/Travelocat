<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'email', 
        'komentar', 
        'T1',
        'T2',
        'R1',
        'R2',
        'S1',
        'S2',
        'A1',
        'A2',
        'E1',
        'E2',
        'rating',
    ];
}
