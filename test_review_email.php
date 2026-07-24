<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$trx = App\Models\Transaction::where('order_id', 'TRX-TEST-491FA')->first();
if (! $trx) {
    echo "Transaction not found\n";
    exit(1);
}
$sent = App\Services\ReviewInvitationService::sendIfDue($trx);
echo $sent ? "EMAIL SENT to {$trx->customer_email}\n" : "EMAIL SKIPPED (status: {$trx->status}, sent_at: " . ($trx->review_email_sent_at ?? 'null') . ")\n";
echo "review_token: " . $trx->fresh()->review_token . "\n";
echo "review_email_sent_at: " . ($trx->fresh()->review_email_sent_at ?? 'null') . "\n";
