<?php

namespace App\Http\Controllers;

use App\Models\Laptop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Exception;

class LaptopController extends Controller
{
    public function index()
    {
        $laptops = Laptop::latest()->get();
        return view('pages.laptops.index', compact('laptops'));
    }

    public function create()
    {
        return view('pages.laptops.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'brand' => 'required|string|max:255',
                'model' => 'required|string|unique:laptops,model|max:255',
                'released_year' => 'nullable|digits:4',
                'status' => 'required|in:Active,Inactive',
                'photo' => 'nullable|image|max:2048',
            ]);

            $data = $request->only(['brand', 'model', 'released_year', 'status']);

            if ($request->hasFile('photo')) {
                $data['photo'] = $request->file('photo')->store('laptops', 'public');
            }

            Laptop::create($data);

            return redirect()
                ->route('laptops.index')
                ->with('success', '✅ Laptop has been successfully created.');
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', '❌ Failed to create laptop. Please try again.');
        }
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
        try {
            $request->validate([
                'brand' => 'required|string|max:255',
                'model' => 'required|string|max:255',
                'released_year' => 'nullable|digits:4',
                'status' => 'required|in:Active,Inactive',
                'photo' => 'nullable|image|max:2048',
            ]);

            $data = $request->only(['brand', 'model', 'released_year', 'status']);

            if ($request->hasFile('photo')) {
                if ($laptop->photo) {
                    Storage::disk('public')->delete($laptop->photo);
                }
                $data['photo'] = $request->file('photo')->store('laptops', 'public');
            }

            $laptop->update($data);

            return redirect()
                ->route('laptops.index')
                ->with('success', '✅ Laptop has been successfully updated.');
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', '❌ Failed to update laptop. Please try again.');
        }
    }

    public function destroy(Laptop $laptop)
    {
        try {
            if ($laptop->photo) {
                Storage::disk('public')->delete($laptop->photo);
            }

            $laptop->delete();

            return redirect()
                ->route('laptops.index')
                ->with('success', '🗑️ Laptop has been successfully deleted.');
        } catch (Exception $e) {
            return redirect()
                ->route('laptops.index')
                ->with('error', '❌ Failed to delete laptop. Please try again.');
        }
    }
}
