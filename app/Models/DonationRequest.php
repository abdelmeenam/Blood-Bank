<?php

namespace App\Models;

use App\Models\City;
use App\Models\Client;
use App\Models\BloodType;
use App\Models\Notification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DonationRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_name', 'patient_age', 'bags_count', 'patient_phone', 'notes',
        'latitude', 'longitude', 'blood_type_id', 'client_id', 'city_id',
        'hospital_name', 'hospital_address'
    ];


    protected static function booted()
    {
        /*
        static::creating(function (DonationRequest $DonationRequest) {
            $DonationRequest->client_id = auth()->id();
        });
        */
    }

    // donation request belongs to a city
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    // donation request belongs to a governorate
    public function governorate()
    {
        return $this->belongsTo(Governorate::class);
    }




    // donation request belongs to a blood type
    public function bloodType()
    {
        return $this->belongsTo(BloodType::class);
    }

    // donation request belongs to a client
    public function client()
    {
        return $this->belongsTo(Client::class);
    }



    // donation request has one notification
    public function notification()
    {
        return $this->hasOne(Notification::class);
    }

    // donation request has many notifications
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}