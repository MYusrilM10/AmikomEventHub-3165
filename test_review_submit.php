<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Review;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\ReviewController;

$trx = App\Models\Transaction::where('order_id', 'TRX-TEST-491FA')->first();
$token = $trx->review_token;

$ctrl = new ReviewController();

// Test 1: showPublicForm
$request = Request::create("/rate/{$trx->order_id}?token={$token}", 'GET');
app()->instance('request', $request);
$response = $ctrl->showPublicForm($request, $trx->order_id);
echo "showPublicForm: " . (method_exists($response, 'getStatusCode') ? $response->getStatusCode() : 'view') . "\n";

// Test 2: submitPublic
$postReq = Request::create("/rate/{$trx->order_id}", 'POST', [
    'token' => $token,
    'rating' => 5,
    'title' => 'Acara yang luar biasa!',
    'review_text' => 'Sangat bermanfaat dan terorganisir dengan baik. Pembicaranya kompeten.',
]);
$response2 = $ctrl->submitPublic($postReq, $trx->order_id);
echo "submitPublic: " . (method_exists($response2, 'getStatusCode') ? $response2->getStatusCode() : 'redirect') . "\n";

// Verify
$r = Review::where('transaction_id', $trx->id)->first();
if ($r) {
    echo "Review created: rating={$r->rating}, title='{$r->title}', event avg=" . $r->event->fresh()->average_rating . "\n";
} else {
    echo "Review NOT created\n";
}
