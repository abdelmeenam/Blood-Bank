<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

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

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            //return 'https://scotturb.com/wp-content/uploads/2016/11/product-placeholder-300x300.jpg';
            return 'https://via.placeholder.com/640x480.png/00aa00?text=' . Str::slug($this->title);
        }
        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }
        return asset('storage/' . $this->image);
        // storage/thumbnail/categories/{image_name}

    } // $category->image_url

}
