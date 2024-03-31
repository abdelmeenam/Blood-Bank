<?php

namespace App\Models;

use App\Models\BloodType;
use App\Models\ClientPost;
use App\Models\DonationRequest;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;


class Client extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'name', 'email', 'password', 'phone', 'dob', 'last_donation_date', 'blood_type_id', 'city_id', 'date_of_birth', 'pin_code', 'api_token'
    ];

    protected $hidden = [
        'password', 'api_token', 'pin_code'
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

    // client belogns to many blood types
    public function bloodTypes()
    {
        return $this->belongsToMany(BloodType::class, 'blood_type_client', 'client_id', 'blood_type_id', 'id', 'id');
    }

    //client belongs to many governates
    public function governorates()
    {
        return $this->belongsToMany(Governorate::class, 'client_governorate', 'client_id', 'governorate_id', 'id', 'id');
    }
}