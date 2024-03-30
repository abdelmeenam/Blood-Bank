<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'content', 'category_id'
    ];

    // post belongs to a category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // post has many clients
    public function clients()
    {
        return $this->belongsToMany(Client::class, 'client_post', 'post_id', 'client_id', 'id', 'id')
            ->using(ClientPost::class);
    }
}
