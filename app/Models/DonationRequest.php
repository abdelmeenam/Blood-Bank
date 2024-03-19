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
        'name', 'age', 'bags_number', 'hospital_name', 'hospital_address', 'phone', 'notes', 'latitude', 'longitude', 'city_id', 'blood_type_id', 'client_id'
    ];

    // donation request belongs to a city
    public function city()
    {
        return $this->belongsTo(City::class);
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
}