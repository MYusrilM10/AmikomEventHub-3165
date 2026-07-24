<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Category;
use App\Models\Event;

echo "=== CATEGORIES ===\n";
foreach (Category::all() as $c) {
    $eventCount = Event::where('category_id', $c->id)->count();
    echo "  [{$c->id}] {$c->name} | events:{$eventCount}\n";
}

echo "\n=== EVENTS WITH CATEGORY ===\n";
foreach (Event::with('category')->get() as $e) {
    $cat = $e->category?->name ?? 'NO CATEGORY';
    echo "  [{$e->id}] {$e->title} | category:{$cat} | date:{$e->date}\n";
}
