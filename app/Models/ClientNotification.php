<?php

namespace App\Models;

use App\Models\Notification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClientNotification extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'notification_id',
        'is_read',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function notification()
    {
        return $this->belongsTo(Notification::class);
    }
}