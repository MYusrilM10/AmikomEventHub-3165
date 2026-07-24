<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Transaction;

$trx = Transaction::where('customer_email', 'Ada@gmail.com')->orderBy('id', 'desc')->first();

echo "Direct link: http://127.0.0.1:8000/rate/{$trx->order_id}?token={$trx->review_token}\n";
