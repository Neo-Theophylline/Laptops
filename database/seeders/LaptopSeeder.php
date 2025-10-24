<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Laptop;

class LaptopSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            ['brand' => 'Asus', 'model' => 'Vivobook 14'],
            ['brand' => 'Acer', 'model' => 'Aspire 5'],
            ['brand' => 'HP', 'model' => 'Pavilion x360'],
            ['brand' => 'Lenovo', 'model' => 'IdeaPad 3'],
            ['brand' => 'Dell', 'model' => 'Inspiron 15']
        ];

        foreach ($brands as $b) {
            Laptop::create([
                'brand' => $b['brand'],
                'model' => $b['model'],
                'status' => 'Active',
            ]);
        }
    }
}
