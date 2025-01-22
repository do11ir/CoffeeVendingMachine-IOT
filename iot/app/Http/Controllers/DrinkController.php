<?php

namespace App\Http\Controllers;

use App\Models\Drink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DrinkController extends Controller
{
    /**
     * Display a listing of the drinks.
     */
    public function index()
    {
        $drinks = Drink::all();
        return view('drinks.index', compact('drinks'));
    }

    /**
     * Show the form for creating a new drink.
     */
    public function create()
    {
        return view('drinks.create');
    }

    /**
     * Store a newly created drink in storage.
     */
    public function store(Request $request)
    {
       
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048',
        ]);

        // Store all the data except for the image (to handle the file separately)
        $data = $request->all();

        if ($request->hasFile('image')) {
            // Store image in 'drink_images' directory within 'storage/app/public'
            $data['image'] = $request->file('image')->store('drink_images', 'public');
        }

        // Create the drink with the image included
        Drink::create($data);

        return redirect()->route('drinks.index')->with('success', 'Drink created successfully.');
    }

    /**
     * Display the specified drink.
     */
    public function show(Drink $drink)
    {
        return view('drinks.show', compact('drink'));
    }

    /**
     * Show the form for editing the specified drink.
     */
    public function edit(Drink $drink)
    {
        return view('drinks.edit', compact('drink'));
    }

    /**
     * Update the specified drink in storage.
     */
    public function update(Request $request, Drink $drink)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($drink->image) {
                Storage::disk('public')->delete($drink->image);
            }

            // Store new image
            $data['image'] = $request->file('image')->store('drink_images', 'public');
        }

        $drink->update($data);

        return redirect()->route('drinks.index')->with('success', 'Drink updated successfully.');
    }

    /**
     * Remove the specified drink from storage.
     */
    public function destroy(Drink $drink)
    {
        if ($drink->image) {
            Storage::disk('public')->delete($drink->image);
        }

        $drink->delete();

        return redirect()->route('drinks.index')->with('success', 'Drink deleted successfully.');
    }
}
