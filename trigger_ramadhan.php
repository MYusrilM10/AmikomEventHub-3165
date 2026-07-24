<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$trx = App\Models\Transaction::where('order_id', 'TRX-1784901788-6eQwO')->first();
if (! $trx) {
    echo "Not found\n";
    exit(1);
}
$sent = App\Services\ReviewInvitationService::sendIfDue($trx);
echo $sent ? "EMAIL SENT to {$trx->customer_email}\n" : "SKIPPED\n";
echo "Token: {$trx->fresh()->review_token}\n";
echo "Link: http://127.0.0.1:8000/rate/{$trx->order_id}?token={$trx->fresh()->review_token}\n";
