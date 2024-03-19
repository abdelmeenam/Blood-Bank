<?php

namespace App\Models;

use App\Models\BloodType;
use App\Models\ClientPost;
use App\Models\DonationRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'password', 'phone', 'dob', 'last_donation_date', 'blood_type_id', 'city_id'
    ];

    //client belongs to a blood type
    public function bloodType()
    {
        return $this->belongsTo(BloodType::class);
    }

    //client has many donation requests
    public function donationRequests()
    {
        return $this->hasMany(DonationRequest::class);
    }

    //client has many posts
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'client_post', 'client_id', 'post_id', 'id', 'id')
            ->using(ClientPost::class);
    }

    //client has many notifications
    public function notifications()
    {
        return $this->belongsToMany(Notification::class, 'client_notification', 'client_id', 'notification_id',  'id', 'id')
            ->using(ClientNotification::class)
            ->withPivot('is_read');
    }
}