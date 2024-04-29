<?php

namespace App\Models;

use App\Models\City;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Governorate extends Model
{
    use HasFactory; //, HasTranslations;

    protected $fillable = [
        'name'
    ];

    //public $translatable = ['name'];

    // governorate has many cities
    public function cities()
    {
        return $this->hasMany(City::class);
    }

    // governorate belongs to many clients
    public function clients()
    {
        return $this->belongsToMany(Client::class);
    }
}