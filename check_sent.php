<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

foreach (App\Models\Transaction::with('event')->whereIn('status', ['success', 'settlement'])->get() as $t) {
    echo "  - {$t->order_id} | sent_at:" . ($t->review_email_sent_at ?? 'NULL') . "\n";
}
