<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceItem;

class ServiceItemSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['service_name' => 'Ganti Thermal Paste', 'price' => 50000],
            ['service_name' => 'Install Ulang Windows', 'price' => 100000],
            ['service_name' => 'Ganti Keyboard Laptop', 'price' => 200000],
            ['service_name' => 'Ganti Baterai Laptop', 'price' => 250000],
            ['service_name' => 'Bersihin Kipas Pendingin', 'price' => 40000],
        ];

        foreach ($items as $item) {
            ServiceItem::create([
                'service_name' => $item['service_name'],
                'price' => $item['price'],
                'status' => 'Active',
            ]);
        }
    }
}
