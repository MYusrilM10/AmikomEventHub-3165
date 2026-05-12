<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil seeder lainnya
        $this->call([
            PartnerSeeder::class,
        ]);

        // User::factory(10)->create();

        \App\Models\User::create([
            'name' => 'Admin Amikom',
            'email' => 'admin@amikom.ac.id',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $category = \App\Models\Category::create([
            'name' => 'Seminar',
            'slug' => 'seminar-it',
        ]);

        $category2 = \App\Models\Category::create([
            'name' => 'Entertaiment',
            'slug' => 'entertaiment',
        ]);

        $category3 = \App\Models\Category::create([
            'name' => 'Workshop',
            'slug' => 'workshop',
        ]);

        \App\Models\Event::create([
            'category_id' => $category2->id,
            'title' => 'Jazz Night 2025',
            'description' => 'Nikmati malam yang indah dengan alunan musik.',
            'date' => '2026-05-10 19:00:00',
            'location' => 'Amikom Baru',
            'price' => 50000,
            'stock' => 100,
            'poster_path' => 'posters/event-1.png',
        ]);

        \App\Models\Event::create([
            'category_id' => $category->id,
            'title' => 'AI Summit & Expo 2026',
            'description' => 'Jelajahi tren terkini dalam bidang Artificial Intelligence.',
            'date' => '2026-05-01 13:00:00',
            'location' => 'Ruang Cinema',
            'price' => 45000,
            'stock' => 150,
            'poster_path' => 'posters/event-2.png',
        ]);

        \App\Models\Event::create([
            'category_id' => $category3->id,
            'title' => 'UI/UX Masterclass',
            'description' => 'Pelajari prinsip-prinsip desain UI/UX dari praktisi berpengalaman.',
            'date' => '2026-05-15 10:00:00',
            'location' => 'Amikom Baru - Lab Desain',
            'price' => 60000,
            'stock' => 80,
            'poster_path' => 'posters/event-3.png',
        ]);

        \App\Models\Event::create([
            'category_id' => $category2->id,
            'title' => 'E-Sport U-Champ',
            'description' => 'Turnamen e-sports terbesar dengan hadiah jutaan rupiah.',
            'date' => '2026-05-20 16:00:00',
            'location' => 'Arena Gaming Amikom',
            'price' => 100000,
            'stock' => 200,
            'poster_path' => 'posters/event-4.png',
        ]);

        \App\Models\Event::create([
            'category_id' => $category3->id,
            'title' => 'Web Development Bootcamp',
            'description' => 'Intensive bootcamp untuk menguasai full-stack web development.',
            'date' => '2026-06-01 08:00:00',
            'location' => 'Amikom Baru - Lab Komputer',
            'price' => 150000,
            'stock' => 50,
            'poster_path' => 'posters/event-5.png',
        ]);

        \App\Models\Event::create([
            'category_id' => $category->id,
            'title' => 'Cloud Computing 101',
            'description' => 'Introduksi lengkap tentang cloud computing dan implementasinya.',
            'date' => '2026-06-10 14:00:00',
            'location' => 'Ruang Seminar A',
            'price' => 55000,
            'stock' => 120,
            'poster_path' => 'posters/event-6.png',
        ]);
    }
}
