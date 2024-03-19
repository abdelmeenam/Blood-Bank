<?php

namespace App\Models;

use App\Models\Post;
use App\Models\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClientPost extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'post_id',
    ];
}