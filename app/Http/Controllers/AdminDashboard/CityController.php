<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Models\City;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get all cities
        $cities = City::with('governorate:id,name')->get();
        $governorates = Governorate::all();
        return view('AdminDashboard.Cities.cities', compact('cities', 'governorates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // validate the request
            $request->validate([
                'name' => 'required|string|max:255',
                'governorate_id' => 'required|exists:governorates,id'
            ]);
            // create a new city
            City::create($request->all());
            toastr()->success(__('City has been added successfully'));
            return redirect()->route('cities.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $city = City::findOrFail($id)->delete();
        toastr()->error(__('City has been deleted successfully'));
        return redirect()->route('cities.index');
    }

    public function getCities($governorateId)
    {
        $cities = City::where('governorate_id', $governorateId)
            ->select('id', 'name')
            ->get();
        if ($cities->isEmpty()) {
            return apiResponse(404, 'No cities found for this governorate');
        }
        return apiResponse(200, 'Cities retrieved successfully', $cities);
    }
}
