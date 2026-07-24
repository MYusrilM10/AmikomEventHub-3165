<?php
// Seed a sample event with past date + 1 success transaction + 1 review
// Usage: C:\xampp\php\php.exe c:\xampp\htdocs\3165_P3\laravel-app\seed_review_test.php

require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Event;
use App\Models\Transaction;
use App\Models\Review;
use App\Models\User;
use App\Models\Category;
use App\Models\Organization;

// Make sure we have an organizer
$org = Organization::firstOrCreate(
    ['slug' => 'bem-amikom'],
    [
        'name' => 'BEM Universitas Amikom',
        'type' => 'bem',
        'email' => 'bem@amikom.ac.id',
        'status' => 'active',
        'commission_percentage' => 10,
    ]
);

// Make sure we have a category
$cat = Category::firstOrCreate(
    ['name' => 'Seminar'],
    ['popularity' => 0]
);

// Make sure we have a user
$user = User::where('email', 'reviewer.test@amikom.ac.id')->first();
if (! $user) {
    $user = User::create([
        'name' => 'Reviewer Test',
        'email' => 'reviewer.test@amikom.ac.id',
        'password' => bcrypt('password'),
        'role' => 'user',
    ]);
}

// Event 14 days in the past (so review email will be triggered)
$event = Event::create([
    'title' => '[TEST] Seminar Pasca-Acara',
    'description' => 'Event uji coba untuk fitur review.',
    'date' => now()->subDays(14),
    'location' => 'Auditorium Amikom',
    'price' => 50000,
    'stock' => 100,
    'category_id' => $cat->id,
    'organization_id' => $org->id,
    'average_rating' => 0,
    'total_reviews' => 0,
]);

// Transaction success
$trx = Transaction::create([
    'user_id' => $user->id,
    'event_id' => $event->id,
    'organization_id' => $org->id,
    'order_id' => 'TRX-TEST-' . strtoupper(substr(md5(time()), 0, 5)),
    'customer_name' => $user->name,
    'customer_email' => $user->email,
    'customer_phone' => '081234567890',
    'total_price' => 55000,
    'platform_fee' => 5000,
    'net_income' => 50000,
    'status' => 'success',
]);

echo "Event ID      : {$event->id}\n";
echo "Event Date    : {$event->date}\n";
echo "Order ID      : {$trx->order_id}\n";
echo "Customer Email: {$trx->customer_email}\n";
echo "\nBuka http://127.0.0.1:8000/success/{$trx->order_id} untuk trigger email review.\n";
echo "Atau generate link langsung: " . route('review.public', ['order_id' => $trx->order_id, 'token' => hash_hmac('sha256', $trx->order_id . '|' . $trx->customer_email, config('app.key'))]) . "\n";
