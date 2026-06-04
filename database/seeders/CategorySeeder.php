<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data kategori default
        $categories = [
            [
                'name' => 'Seminar',
                'description' => 'Acara seminar dan presentasi ilmiah'
            ],
            [
                'name' => 'Entertainment',
                'description' => 'Acara hiburan dan pertunjukan seni'
            ],
            [
                'name' => 'Workshop',
                'description' => 'Acara workshop dan pelatihan hands-on'
            ],
            [
                'name' => 'Conference',
                'description' => 'Konferensi dan diskusi profesional'
            ],
            [
                'name' => 'Sports',
                'description' => 'Acara olahraga dan kompetisi'
            ],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['name' => $category['name']],
                ['description' => $category['description']]
            );
        }
    }
}
