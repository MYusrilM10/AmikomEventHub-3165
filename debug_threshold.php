<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Transaction;

echo "=== ALL Transactions ===\n";
foreach (Transaction::with('event')->get() as $t) {
    echo sprintf(
        "[id:%d] %s | email:%s | status:%s | event:%s (date:%s) | sent_at:%s\n",
        $t->id,
        $t->order_id,
        $t->customer_email,
        $t->status,
        $t->event->title ?? 'N/A',
        $t->event->date ?? 'N/A',
        $t->review_email_sent_at ?? 'NULL'
    );
}

echo "\n=== Threshold check ===\n";
echo "Now: " . now() . "\n";
echo "H-1 (24 jam lalu): " . now()->copy()->subDay() . "\n";

echo "\n=== Qualifying for daily command ===\n";
$threshold = now()->copy()->subDay();
$qual = Transaction::with('event')
    ->whereIn('status', ['success', 'settlement'])
    ->whereNull('review_email_sent_at')
    ->whereHas('event', function ($q) use ($threshold) {
        $q->where('date', '<=', $threshold);
    })
    ->get();
echo "Count: " . $qual->count() . "\n";
foreach ($qual as $q) {
    echo "  - {$q->order_id} | event.date:{$q->event->date}\n";
}
