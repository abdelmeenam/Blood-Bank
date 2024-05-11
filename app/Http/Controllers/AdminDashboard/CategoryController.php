<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('AdminDashboard.Categories.categories', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
        ], [
            'name.required' => __('Category name is required'),
            'name.string' => __('Category name must be string'),
            'name.max' => __('Category name must be less than 255 characters'),
        ]);

        Category::create($request->all());
        // Redirect to the categories page with success message and toastr notification
        toastr()->success(__('Category has been added successfully'));
        return redirect()->route('categories.index');
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
        //delete the category
        $category = Category::findOrFail($id);
        $category->delete();
        // Redirect to the categories page with success message and toastr notification
        toastr()->success(__('Category has been deleted successfully'));
        return redirect()->route('categories.index');
    }
}