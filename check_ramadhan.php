<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Transaction;

echo "=== Transactions for Ramadhan ===\n";
$trx = Transaction::with('event')
    ->where('customer_name', 'like', '%Ramadhan%')
    ->orWhere('customer_email', 'like', '%Ramadhan%')
    ->orWhere('customer_email', 'like', '%Ramad%')
    ->orderBy('id', 'desc')
    ->get();

if ($trx->isEmpty()) {
    echo "No Ramadhan transaction found. Recent success transactions:\n";
    foreach (Transaction::with('event')->whereIn('status', ['success', 'settlement'])->orderBy('id', 'desc')->limit(5)->get() as $t) {
        echo "  [{$t->id}] {$t->order_id} | email:{$t->customer_email} | name:{$t->customer_name} | status:{$t->status} | event:{$t->event->title} (date:{$t->event->date}) | sent_at:" . ($t->review_email_sent_at ?? 'NULL') . "\n";
    }
} else {
    foreach ($trx as $t) {
        echo "[{$t->id}] {$t->order_id} | email:{$t->customer_email} | status:{$t->status} | event:{$t->event->title} (date:{$t->event->date}) | sent_at:" . ($t->review_email_sent_at ?? 'NULL') . " | token:" . ($t->review_token ? 'EXISTS' : 'NULL') . "\n";
    }
}
