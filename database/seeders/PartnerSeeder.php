<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Partner;

class PartnerSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Hanya buat partners jika belum ada
        if (Partner::count() == 0) {
            for ($i = 1; $i <= 5; $i++) {
                Partner::create([
                    'name' => fake()->company(),
                    'logo_url' => "https://placehold.co/200x200?text=Partner+" . $i,
                ]);
            }
        }
    }
}
