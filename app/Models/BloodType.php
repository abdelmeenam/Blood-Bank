<?php

namespace App\Models;

use App\Models\Client;
use App\Models\DonationRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BloodType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];


    //blood type has many clients
    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    //blood type has many donation requests
    public function donationRequests()
    {
        return $this->hasMany(DonationRequest::class);
    }
}