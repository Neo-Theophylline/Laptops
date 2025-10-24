<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Laptop;
use App\Models\Service;
use App\Models\ServiceItem;
use App\Models\ServiceDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with(['customer', 'technician', 'laptop', 'details.serviceItem'])
            ->latest()
            ->get();

        return view('pages.services.index', compact('services'));
    }

    public function create()
    {
        $customers = User::where('role', 'Customer')->where('status', 'Active')->get();
        $technicians = User::where('role', 'Technician')->where('status', 'Active')->get();
        $laptops = Laptop::where('status', 'Active')->get();
        $serviceItems = ServiceItem::where('status', 'Active')->get();

        return view('pages.services.create', compact('customers', 'technicians', 'laptops', 'serviceItems'));
    }

    public function store(Request $request)
    {
        $request->merge([
            'other_cost' => str_replace('.', '', $request->other_cost ?? 0),
            'price' => array_map(fn($p) => str_replace('.', '', $p), $request->price ?? []),
        ]);

        $request->validate([
            'customer_id' => 'required|exists:users,id',
            'technician_id' => 'required|exists:users,id',
            'laptop_id' => 'required|exists:laptops,id',
            'damage_description' => 'nullable|string',
            'service_item' => 'required|array',
            'service_item.*' => 'exists:service_items,id',
            'price' => 'required|array',
            'price.*' => 'numeric',
            'other_cost' => 'nullable|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            $count = Service::count() + 1;
            $invoice = 'INV-' . date('Ymd') . '-' . str_pad($count, 3, '0', STR_PAD_LEFT);

            $estimatedCost = array_sum($request->price ?? []);
            $otherCost = (int) $request->other_cost;
            $totalCost = $estimatedCost + $otherCost;

            $service = Service::create([
                'no_invoice' => $invoice,
                'customer_id' => $request->customer_id,
                'technician_id' => $request->technician_id,
                'laptop_id' => $request->laptop_id,
                'damage_description' => $request->damage_description,
                'estimated_cost' => $estimatedCost,
                'other_cost' => $otherCost,
                'total_cost' => $totalCost,
                'received_date' => now(),
                'status' => 'accepted',
                'payment_status' => 'unpaid',
                'paymentmethod' => 'cash',
            ]);

            foreach ($request->service_item as $index => $serviceItemId) {
                ServiceDetail::create([
                    'service_id' => $service->id,
                    'service_item_id' => $serviceItemId,
                    'price' => $request->price[$index] ?? 0,
                ]);
            }

            DB::commit();
            return redirect()->route('services.index')->with('success', '✅ Service has been successfully created.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', '❌ Failed to create service. Please try again.');
        }
    }

    public function edit(Service $service)
    {
        $customers = User::where('role', 'Customer')->where('status', 'Active')->get();
        $technicians = User::where('role', 'Technician')->where('status', 'Active')->get();
        $laptops = Laptop::where('status', 'Active')->get();

        return view('pages.services.edit', compact('service', 'customers', 'technicians', 'laptops'));
    }

    public function update(Request $request, Service $service)
    {
        $request->merge([
            'estimated_cost' => str_replace('.', '', $request->estimated_cost ?? 0),
            'other_cost' => str_replace('.', '', $request->other_cost ?? 0),
            'paid' => str_replace('.', '', $request->paid ?? 0),
        ]);

        $request->validate([
            'customer_id' => 'required|exists:users,id',
            'technician_id' => 'required|exists:users,id',
            'laptop_id' => 'required|exists:laptops,id',
            'damage_description' => 'nullable|string',
            'estimated_cost' => 'nullable|numeric',
            'other_cost' => 'nullable|numeric',
            'status' => 'required|string',
            'paymentmethod' => 'required|string',
            'payment_status' => 'required|string',
            'paid' => 'nullable|numeric|min:0',
        ]);

        try {
            $estimatedCost = (int) $request->estimated_cost;
            $otherCost = (int) $request->other_cost;
            $totalCost = $estimatedCost + $otherCost;
            $paid = (int) $request->paid;
            $change = max(0, $paid - $totalCost);

            $completedDate = $service->completed_date;
            if ($request->status === 'finished' && !$completedDate) {
                $completedDate = now();
            } elseif ($request->status !== 'finished') {
                $completedDate = null;
            }

            $service->update([
                'customer_id' => $request->customer_id,
                'technician_id' => $request->technician_id,
                'laptop_id' => $request->laptop_id,
                'damage_description' => $request->damage_description,
                'estimated_cost' => $estimatedCost,
                'other_cost' => $otherCost,
                'total_cost' => $totalCost,
                'paymentmethod' => $request->paymentmethod,
                'payment_status' => $request->payment_status,
                'status' => $request->status,
                'paid' => $paid,
                'change' => $change,
                'completed_date' => $completedDate,
            ]);

            return redirect()->route('services.index')->with('success', '✅ Service has been successfully updated.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', '❌ Failed to update service. Please try again.');
        }
    }

    public function show($id)
    {
        $service = Service::with(['customer', 'technician', 'laptop', 'details.serviceItem'])->findOrFail($id);
        return view('pages.services.show', compact('service'));
    }

   public function updateDetail(Request $request, $id)
{
    $service = Service::findOrFail($id);

    // Bersihkan format angka dari titik ribuan
    $request->merge([
        'other_cost' => str_replace('.', '', $request->other_cost ?? 0),
        'paid' => str_replace('.', '', $request->paid ?? 0),
    ]);

    // Validasi input
    $request->validate([
        'status' => 'required|string|in:accepted,process,finished,taken,cancelled',
        'other_cost' => 'nullable|numeric|min:0',
        'paymentmethod' => 'nullable|string|in:cash,transfer',
        'paid' => 'nullable|numeric|min:0',
    ]);

    try {
        // Ambil nilai lama
        $estimatedCost = (int) $service->estimated_cost;
        $otherCost = (int) $request->other_cost;
        $totalCost = $estimatedCost + $otherCost;

        // Tambahkan pembayaran baru ke total sebelumnya
        $previousPaid = (int) $service->paid;
        $newPaid = (int) $request->paid;
        $totalPaid = $previousPaid + $newPaid;

        // Hitung sisa dan kembalian
        $remaining = max(0, $totalCost - $totalPaid);
        $change = max(0, $totalPaid - $totalCost);

        // Tentukan status pembayaran otomatis
        if ($totalPaid <= 0) {
            $paymentStatus = 'unpaid';
        } elseif ($totalPaid < $totalCost) {
            $paymentStatus = 'debt';
        } else {
            $paymentStatus = 'paid';
        }

        // Atur tanggal selesai
        $completedDate = $service->completed_date;
        if ($request->status === 'finished' && !$completedDate) {
            $completedDate = now();
        } elseif ($request->status !== 'finished') {
            $completedDate = null;
        }

        // Update data ke database
        $service->update([
            'status' => $request->status,
            'other_cost' => $otherCost,
            'total_cost' => $totalCost,
            'paymentmethod' => $request->paymentmethod ?? $service->paymentmethod,
            'paid' => $totalPaid, // total akumulasi
            'change' => $change,
            'payment_status' => $paymentStatus,
            'completed_date' => $completedDate,
        ]);

        return redirect()
            ->route('services.show', $service->id)
            ->with('success', '✅ Service payment successfully updated (partial payment supported).');
    } catch (Exception $e) {
        return redirect()
            ->back()
            ->with('error', '❌ Failed to update service details. Please try again.');
    }
}


    public function destroy(Service $service)
    {
        try {
            $service->delete();
            return redirect()->route('services.index')->with('success', '🗑️ Service has been successfully deleted.');
        } catch (Exception $e) {
            return redirect()->route('services.index')->with('error', '❌ Failed to delete service. Please try again.');
        }
    }
}
