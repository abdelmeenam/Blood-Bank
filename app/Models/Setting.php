<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'about_app', 'phone', 'email', 'fb_link', 'tw_link', 'insta_link', 'whats_link', 'youtube_link', 'notification_settings_text', 'google_link'

    ];
}