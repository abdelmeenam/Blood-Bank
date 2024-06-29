<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use App\Models\DonationRequest;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get all donations with city and country and blood type and client
        $donations = DonationRequest::with('city', 'governorate', 'bloodType', 'client')->paginate(6); // 6 donations per page
        return view('AdminDashboard.Donations.donations', compact('donations'));
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
        //
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
        //delete donation request with it's id and his own relations
        $donation = DonationRequest::find($id);
        $donation->delete();

        //redirect to the donations page with a toast message

        toastr()->success(__('Donation Deleted Successfully'));
        return redirect()->route('donations.index');
    }
}
