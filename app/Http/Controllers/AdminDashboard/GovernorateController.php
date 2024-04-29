<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminDashboardRequests\CreateGovernorateRequest;

class GovernorateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $governorates = Governorate::all();
        return view('AdminDashboard.Governorates.governorates', compact('governorates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //valide governorate name

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateGovernorateRequest $request)
    {

        try {
            //validate governorate the request
            $request->validated();
            //$governorate = new Governorate();
            //$translations = ['en' => $request->name_en, 'ar' => $request->name];
            //$governorate->name = $translations;
            //$governorate->save();
            $governorate = Governorate::create($request->all());
            toastr()->success(__('Governorate has been added successfully'));
            return redirect()->route('governorates.index');
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
        try {
            $request->validate([
                'name' => 'sometimes|string|max:255|unique:governorates,name,' . $id . ',id',
            ]);
            $governorate = Governorate::findOrFail($id);
            $governorate->update(['name' => $request->name,]);
            toastr()->success(trans('messages.Update'));
            return redirect()->route('governorates.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $governorate = Governorate::findOrFail($id)->delete();
        toastr()->error(__('Governorate has been deleted successfully'));
        return redirect()->route('governorates.index');
    }
}
