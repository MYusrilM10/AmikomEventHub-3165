<?php
// Reset review state for test transaction so we can test the public form again
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Transaction;
use App\Models\Review;
use App\Services\ReviewInvitationService;

$trx = Transaction::where('order_id', 'TRX-TEST-491FA')->first();
if (! $trx) {
    echo "Transaction not found\n";
    exit(1);
}

// Force delete (bukan soft delete) agar slot transaction_id di-unique constraint
$deleted = Review::withTrashed()->where('transaction_id', $trx->id)->forceDelete();
echo "Force-deleted $deleted review(s)\n";

// Reset token & sent_at
$trx->review_email_sent_at = null;
$trx->review_token = hash_hmac('sha256', $trx->order_id . '|' . $trx->customer_email, config('app.key'));
$trx->save();

// Kirim ulang email
$sent = ReviewInvitationService::sendIfDue($trx);
echo $sent ? "Email re-sent to {$trx->customer_email}\n" : "Email skipped\n";

echo "\nDirect link (jika tidak mau via email):\n";
echo "http://127.0.0.1:8000/rate/{$trx->order_id}?token={$trx->review_token}\n";
