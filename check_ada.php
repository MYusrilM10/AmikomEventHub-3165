<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Transaction;

$trx = Transaction::where('customer_email', 'Ada@gmail.com')
    ->orWhere('customer_email', 'ada@gmail.com')
    ->orderBy('id', 'desc')
    ->first();

if (! $trx) {
    echo "Transaction not found for Ada@gmail.com\n";
    echo "Recent transactions:\n";
    foreach (Transaction::orderBy('id', 'desc')->limit(10)->get() as $t) {
        echo "  - [{$t->id}] {$t->order_id} | {$t->customer_email} | status:{$t->status} | event:{$t->event_id} | sent_at:" . ($t->review_email_sent_at ?? 'null') . "\n";
    }
    exit(1);
}

echo "Found transaction:\n";
echo "  ID: {$trx->id}\n";
echo "  Order: {$trx->order_id}\n";
echo "  Email: {$trx->customer_email}\n";
echo "  Status: {$trx->status}\n";
echo "  Event: {$trx->event->title} (id:{$trx->event_id})\n";
echo "  Event date: {$trx->event->date}\n";
echo "  Now: " . now() . "\n";
echo "  review_email_sent_at: " . ($trx->review_email_sent_at ?? 'null') . "\n";
echo "  review_token: " . ($trx->review_token ?? 'null') . "\n";

if (! $trx->review_email_sent_at) {
    echo "\nEmail review BELUM terkirim. Force triggering...\n";
    $trx->refresh();
    \App\Services\ReviewInvitationService::sendIfDue($trx);
    $trx->refresh();
    echo "Now review_email_sent_at: " . ($trx->review_email_sent_at ?? 'null') . "\n";
}
