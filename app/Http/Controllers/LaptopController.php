<?php

namespace App\Http\Controllers;

use App\Models\Laptop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaptopController extends Controller
{
    public function index()
    {
        $laptops = Laptop::all();
        return view('pages.laptops.index', compact('laptops'));
    }

    public function create()
    {
        return view('pages.laptops.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'released_year' => 'nullable|digits:4',
            'status' => 'required|in:Active,Inactive',
            'photo' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('laptops', 'public');
        }

        Laptop::create($data);

        return redirect()->route('laptops.index')->with('success', 'Laptop created successfully.');
    }

    public function show(Laptop $laptop)
    {
        return view('pages.laptops.show', compact('laptop'));
    }

    public function edit(Laptop $laptop)
    {
        return view('pages.laptops.edit', compact('laptop'));
    }

    public function update(Request $request, Laptop $laptop)
    {
        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'released_year' => 'nullable|digits:4',
            'status' => 'required|in:Active,Inactive',
            'photo' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            // hapus photo lama
            if ($laptop->photo) {
                Storage::disk('public')->delete($laptop->photo);
            }
            $data['photo'] = $request->file('photo')->store('laptops', 'public');
        }

        $laptop->update($data);

        return redirect()->route('laptops.index')->with('success', 'Laptop updated successfully.');
    }

    public function destroy(Laptop $laptop)
    {
        if ($laptop->photo) {
            Storage::disk('public')->delete($laptop->photo);
        }
        $laptop->delete();

        return redirect()->route('laptops.index')->with('success', 'Laptop deleted successfully.');
    }
}
