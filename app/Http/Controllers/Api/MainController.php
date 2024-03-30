<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use App\Models\Post;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    public function getAllGovernates()
    {
        $governates = Governorate::all();
        return apiResponse(200, 'success', $governates);
    }


    public function getAllCities()
    {
        $governorateId = request()->governorate_id;
        $cities = City::when($governorateId, fn ($query) => $query->where('governorate_id', $governorateId))->get();
        return apiResponse(200, 'success', $cities);
    }
}
