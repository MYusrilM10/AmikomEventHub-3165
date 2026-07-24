<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$mw = new App\Http\Middleware\TriggerPendingReviewEmails();

$paths = ['/', '/events/10', '/panitia/hima-si'];
foreach ($paths as $p) {
    $req = Illuminate\Http\Request::create($p, 'GET');
    app()->instance('request', $req);
    $mw->handle($req, fn($r) => new Illuminate\Http\Response('OK'));
}

echo "Done. Re-check sent_at:\n";
foreach (App\Models\Transaction::with('event')->whereIn('status', ['success', 'settlement'])->whereHas('event', function ($q) { $q->where('date', '<=', now()); })->get() as $t) {
    echo "  - {$t->order_id} | sent_at:" . ($t->review_email_sent_at ?? 'NULL') . "\n";
}
