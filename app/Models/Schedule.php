<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'court',
        'price',
        'schedule_date',
        'schedule',
        'status',
        'user_id', // Added user_id to fillable
    ];

    // Added relationship to User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
