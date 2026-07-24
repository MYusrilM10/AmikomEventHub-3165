<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Event;

// Simulate ?category=seminar
$req = Illuminate\Http\Request::create('/?category=seminar', 'GET');
app()->instance('request', $req);
$ctrl = new App\Http\Controllers\HomeController();
$response = $ctrl->index($req);
$data = $response->getData();
echo "Filter: ?category=seminar\n";
echo "Events: " . count($data['events']) . "\n";
foreach ($data['events'] as $e) {
    echo "  - {$e->title} ({$e->category->name})\n";
}

echo "\nFilter: ?category=workshop\n";
$req2 = Illuminate\Http\Request::create('/?category=workshop', 'GET');
app()->instance('request', $req2);
$response2 = $ctrl->index($req2);
$data2 = $response2->getData();
echo "Events: " . count($data2['events']) . "\n";
foreach ($data2['events'] as $e) {
    echo "  - {$e->title} ({$e->category->name})\n";
}
