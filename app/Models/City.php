<?php

namespace App\Models;

use App\Models\Governorate;
use App\Models\DonationRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'governorate_id'
    ];

    // city belongs to a governorate
    public function governorate()
    {
        return $this->belongsTo(Governorate::class);
    }

    // city has many donation requests
    public function donationRequests()
    {
        return $this->hasMany(DonationRequest::class);
    }
}