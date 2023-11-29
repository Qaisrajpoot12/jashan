<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class favorite extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'user_id',
        'organizer_id',
        'status',
    ];
}
