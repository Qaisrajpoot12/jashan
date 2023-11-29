<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_name',
        'cover_img',
        'profile_img',
        'banner_img',
        'description',
        'organizer_id',
        'event_slug',
        'country',
        'city',
        'event_start_date',
        'event_end_date',
        'fb_link',
        'tw_link',
        'sk_link',
        'what_link',
        'linkedin_link',
        'other_link',
    ];
}
