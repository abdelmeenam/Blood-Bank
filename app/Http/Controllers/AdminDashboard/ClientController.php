<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Models\City;
use App\Models\Client;
use App\Models\BloodType;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $bloodTypes = BloodType::all();
        $cities = City::all();
        $governorates = Governorate::all();
        $clientsQuery = Client::with('bloodType:id,name', 'city:id,name', 'governorate:id,name');

        if (request()->has('status')) {
            $clientsQuery->byStatus(request()->status);
        }

        $clients = $clientsQuery->paginate(4);
        return view('AdminDashboard.Clients.clients', compact('clients', 'bloodTypes', 'cities', 'governorates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function searchClients(Request $request)
    {
        $bloodTypes = BloodType::all();
        $cities = City::all();
        $governorates = Governorate::all();
        $search = $request->input('search');

        if ($search) {
            $clients = Client::search($search)->paginate(4);
        }


        return view('AdminDashboard.Clients.clients', compact('clients', 'bloodTypes', 'cities', 'governorates'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            $rules = [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'last_donation_date' => 'required|date',
                'date_of_birth' => 'required|date',
                'blood_type_id' => 'required|exists:blood_types,id',
                'is_active' => 'required|in:0,1',
                'city_id' => 'required|exists:cities,id',
                'governorate_id' => 'required|exists:governorates,id',
                'phone' => 'required|string|max:255|unique:clients,phone',
                'password' => 'required|string|min:6',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors());
            }
            // create a new client
            Client::create($request->all());
            toastr()->success(__('Client has been added successfully'));
            return redirect()->route('clients.index');
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //delete client
        $client = Client::findOrFail($id)->delete();
        toastr()->error(__('Client has been deleted successfully'));
        return redirect()->route('clients.index');
    }

    public function updateUserStatus(Request $request, string $id)
    {
        //change client status
        $client = Client::findOrFail($id);
        $client->is_active = $request->input('is_active');
        $client->save();
        return response()->json(['status' => true, 'message' => __('Client status has been changed successfully')]);
    }

    //filter clients by status
    public function filterClients(Request $request)
    {
        $clients = Client::where('is_active', $request->status)->get();
        $bloodTypes = BloodType::all();
        $cities = City::all();
        $governorates = Governorate::all();
        return view('AdminDashboard.Clients.clients', compact('clients', 'bloodTypes', 'cities', 'governorates'));
    }
}