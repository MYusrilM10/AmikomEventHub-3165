<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$org = App\Models\Organization::where('slug', 'bem-amikom')->first();
echo "Org: {$org->name} (id: {$org->id})\n";
echo "Events total: " . $org->events()->count() . "\n";
foreach ($org->events()->get() as $e) {
    echo "  - ID:{$e->id} | {$e->title} | {$e->date} | stock:{$e->stock}\n";
}
echo "\nTransactions for this org:\n";
foreach ($org->transactions()->latest()->get() as $t) {
    echo "  - order:{$t->order_id} | status:{$t->status} | total:{$t->total_price} | event_id:{$t->event_id}\n";
}
echo "\nReviews:\n";
foreach (App\Models\Review::withTrashed()->get() as $r) {
    echo "  - event_id:{$r->event_id} | tx_id:{$r->transaction_id} | rating:{$r->rating} | deleted:{$r->deleted_at}\n";
}
