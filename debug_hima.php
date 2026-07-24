<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$hima = App\Models\Organization::where('slug', 'hima-si')->first();
echo "HIMA SI id:{$hima->id}\n";
echo "Events: " . $hima->events()->count() . "\n";
foreach ($hima->events()->get() as $e) {
    echo "  - id:{$e->id} | {$e->title} | date:{$e->date}\n";
}

// Test query yang dipakai di profile
$eventIds = $hima->events->pluck('id');
echo "\nEvent IDs: " . $eventIds->implode(',') . "\n";
$reviews = App\Models\Review::whereIn('event_id', $eventIds)->where('is_verified_purchase', true)->get();
echo "Reviews: " . $reviews->count() . "\n";
foreach ($reviews as $r) {
    echo "  - rating:{$r->rating} | event_id:{$r->event_id} | {$r->customer_name}\n";
}
