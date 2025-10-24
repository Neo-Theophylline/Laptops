<?php

namespace App\Http\Controllers;

use App\Models\ServiceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Exception;

class ServiceItemController extends Controller
{
    public function index()
    {
        $serviceItems = ServiceItem::latest()->get();
        return view('pages.serviceitems.index', compact('serviceItems'));
    }

    public function create()
    {
        return view('pages.serviceitems.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'service_name' => 'required|string|unique:service_items,service_name|max:255',
                'price' => 'required|string|max:255',
                'status' => 'required|in:Active,Inactive',
                'photo' => 'nullable|image|max:2048',
            ]);

            $data = $request->only(['service_name', 'price', 'status']);

            if ($request->hasFile('photo')) {
                $data['photo'] = $request->file('photo')->store('serviceitems', 'public');
            }

            ServiceItem::create($data);

            return redirect()
                ->route('serviceitems.index')
                ->with('success', '✅ Service item has been successfully created.');
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', '❌ Failed to create service item. Please try again.');
        }
    }

    public function show(ServiceItem $serviceitem)
    {
        return view('pages.serviceitems.show', ['serviceItem' => $serviceitem]);
    }

    public function edit(ServiceItem $serviceitem)
    {
        return view('pages.serviceitems.edit', ['serviceItem' => $serviceitem]);
    }

    public function update(Request $request, ServiceItem $serviceitem)
    {
        try {
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

            return redirect()
                ->route('serviceitems.index')
                ->with('success', '✅ Service item has been successfully updated.');
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', '❌ Failed to update service item. Please try again.');
        }
    }

    public function destroy(ServiceItem $serviceitem)
    {
        try {
            if ($serviceitem->photo) {
                Storage::disk('public')->delete($serviceitem->photo);
            }

            $serviceitem->delete();

            return redirect()
                ->route('serviceitems.index')
                ->with('success', '🗑️ Service item has been successfully deleted.');
        } catch (Exception $e) {
            return redirect()
                ->route('serviceitems.index')
                ->with('error', '❌ Failed to delete service item. Please try again.');
        }
    }
}
