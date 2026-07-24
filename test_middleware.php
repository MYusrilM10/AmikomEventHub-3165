<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$req = Illuminate\Http\Request::create('/', 'GET');
app()->instance('request', $req);
$mw = new App\Http\Middleware\TriggerPendingReviewEmails();
$mw->handle($req, fn($r) => $r);
echo "Middleware executed. Check Mailtrap now.\n";

echo "\nTransactions now:\n";
foreach (App\Models\Transaction::with('event')->whereIn('status', ['success', 'settlement'])->get() as $t) {
    echo "  - {$t->order_id} | sent_at:" . ($t->review_email_sent_at ?? 'NULL') . "\n";
}
