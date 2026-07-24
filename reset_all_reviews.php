<?php
// Reset semua review_email_sent_at ke NULL untuk demo lazy trigger
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Transaction;

$trxs = Transaction::with('event')
    ->whereIn('status', ['success', 'settlement'])
    ->whereNotNull('review_email_sent_at')
    ->whereHas('event', function ($q) {
        $q->where('date', '<=', now());
    })
    ->get();

foreach ($trxs as $t) {
    $t->review_email_sent_at = null;
    $t->review_token = null;
    $t->save();
    echo "Reset: {$t->order_id} ({$t->customer_email})\n";
}
echo "Total reset: " . $trxs->count() . "\n";
