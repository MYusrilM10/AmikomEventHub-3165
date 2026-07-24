<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Transaction;

$trx = Transaction::where('customer_email', 'Ada@gmail.com')->orderBy('id', 'desc')->first();
$trx->review_email_sent_at = null;
$trx->review_token = null;
$trx->save();
echo "Reset review_email_sent_at for order: {$trx->order_id}\n";
