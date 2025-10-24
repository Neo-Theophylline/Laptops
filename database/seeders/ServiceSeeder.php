<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\ServiceDetail;
use App\Models\User;
use App\Models\Laptop;
use App\Models\ServiceItem;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $customers = User::where('role', 'Customer')->get();
        $technicians = User::where('role', 'Technician')->get();
        $laptops = Laptop::all();
        $serviceItems = ServiceItem::all();

        // Pastikan data referensi sudah ada
        if ($customers->isEmpty() || $technicians->isEmpty() || $laptops->isEmpty() || $serviceItems->isEmpty()) {
            $this->command->warn('⚠️ Data belum lengkap (users, laptops, service_items) — seeder dilewati.');
            return;
        }

        foreach (range(1, 5) as $i) {
            $customer = $customers->random();
            $technician = $technicians->random();
            $laptop = $laptops->random();


            $invoice = 'INV-' . date('Ymd') . '-' . str_pad(Service::count() + 1, 3, '0', STR_PAD_LEFT);


            $selectedItems = $serviceItems->random(rand(1, 3));

            $estimatedCost = $selectedItems->sum('price');
            $otherCost = rand(10_000, 50_000);
            $totalCost = $estimatedCost + $otherCost;


            $paid = $totalCost + rand(0, 100_000);
            $change = max(0, $paid - $totalCost);

            $service = Service::create([
                'no_invoice' => $invoice,
                'customer_id' => $customer->id,
                'technician_id' => $technician->id,
                'laptop_id' => $laptop->id,
                'damage_description' => 'Kerusakan umum pada laptop, perlu perbaikan kecil.',
                'estimated_cost' => $estimatedCost,
                'other_cost' => $otherCost,
                'total_cost' => $totalCost,
                'paid' => $paid,
                'change' => $change,
                'paymentmethod' => 'cash',
                'payment_status' => 'paid',
                'status' => 'accepted',
                'received_date' => now(),
                'completed_date' => null,
            ]);


            foreach ($selectedItems as $item) {
                ServiceDetail::create([
                    'service_id' => $service->id,
                    'service_item_id' => $item->id,
                    'price' => $item->price,
                ]);
            }
        }
    }
}
