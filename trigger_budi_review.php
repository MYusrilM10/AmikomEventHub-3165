<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Transaction;
use App\Services\ReviewInvitationService;

$trx = Transaction::where('order_id', 'TRX-1784828225-fqR8b')->first();
if (! $trx) {
    echo "Transaction not found\n";
    exit(1);
}

echo "Status: {$trx->status}\n";
echo "Event date: {$trx->event->date}\n";
echo "Now: " . now() . "\n\n";

// Force re-send
$trx->review_email_sent_at = null;
$trx->save();
$sent = ReviewInvitationService::sendIfDue($trx);
echo $sent ? "EMAIL SENT\n" : "EMAIL SKIPPED\n";

echo "\nDirect link: http://127.0.0.1:8000/rate/{$trx->order_id}?token={$trx->fresh()->review_token}\n";
