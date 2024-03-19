<?php

namespace App\Models;

use App\Models\DonationRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'content', 'donation_request_id'
    ];

    //notification belongs to a donation request
    public function donationRequest()
    {
        return $this->belongsTo(DonationRequest::class);
    }

    //notification belongs to many clients
    public function clients()
    {
        return $this->belongsToMany(Client::class, 'client_notification', 'notification_id', 'client_id',  'id', 'id')
            ->using(ClientNotification::class)
            ->withPivot('is_read');
    }
}