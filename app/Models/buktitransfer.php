<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class buktitransfer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'foto',
        'no_invoice',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'no_invoice', 'no_invoice');
    }
}
