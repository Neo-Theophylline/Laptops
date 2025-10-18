<?php

namespace App\Http\Controllers;

use App\Models\ServiceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceItemController extends Controller
{
    public function index()
    {
        $serviceItems = ServiceItem::all(); // konsisten penamaan
        return view('pages.serviceitems.index', compact('serviceItems'));
    }

    public function create()
    {
        return view('pages.serviceitems.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_name' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'status' => 'required|in:Active,Inactive',
            'photo' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['service_name', 'price', 'status']);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('serviceitems', 'public');
        }

        ServiceItem::create($data);

        return redirect()->route('serviceitems.index')->with('success', 'Service Item created successfully.');
    }

    // show method tetap
    public function show(ServiceItem $serviceitem)
    {
        // kirim object sebagai $serviceItem ke Blade
        return view('pages.serviceitems.show', ['serviceItem' => $serviceitem]);
    }

    // edit method diperbaiki agar route binding konsisten
    public function edit(ServiceItem $serviceitem)
    {
        return view('pages.serviceitems.edit', ['serviceItem' => $serviceitem]);
    }

    // update method
    public function update(Request $request, ServiceItem $serviceitem)
    {
        $request->validate([
            'service_name' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'status' => 'required|in:Active,Inactive',
            'photo' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['service_name', 'price', 'status']);

        if ($request->hasFile('photo')) {
            if ($serviceitem->photo) {
                Storage::disk('public')->delete($serviceitem->photo);
            }
            $data['photo'] = $request->file('photo')->store('serviceitems', 'public');
        }

        $serviceitem->update($data);

        return redirect()->route('serviceitems.index')->with('success', 'Service Item updated successfully.');
    }

    // destroy method
    public function destroy(ServiceItem $serviceitem)
    {
        if ($serviceitem->photo) {
            Storage::disk('public')->delete($serviceitem->photo);
        }

        $serviceitem->delete();

        return redirect()->route('serviceitems.index')->with('success', 'Service Item deleted successfully.');
    }
}
