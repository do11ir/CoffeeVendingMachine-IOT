<?php

namespace Database\Seeders;

use App\Models\Drink;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DrinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Drink::create([
            'name' => 'چای',
            'description' => 'یک نوشیدنی داغ و تازه که با برگ‌های چای تهیه می‌شود.',
            'price' => 20000,
            'image' => 'https://via.placeholder.com/150?text=Tea',
        ]);

        Drink::create([
            'name' => 'چای کاراک',
            'description' => 'چای قوی با شیر و ادویه‌جات.',
            'price' => 35000,
            'image' => 'https://via.placeholder.com/150?text=Karak+Tea',
        ]);

        Drink::create([
            'name' => 'چای ماسالا',
            'description' => 'چای معطر و ادویه‌دار که با انواع ادویه‌های خوشبو تهیه می‌شود.',
            'price' => 35000,
            'image' => 'https://via.placeholder.com/150?text=Masala+Tea',
        ]);

        Drink::create([
            'name' => 'نسکافه',
            'description' => 'نوشیدنی قهوه فوری تهیه شده با پودر نسکافه.',
            'price' => 40000,
            'image' => 'https://via.placeholder.com/150?text=Nescafe',
        ]);
    }
}
