<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$e = App\Models\Event::find(9);
echo "Event: {$e->title}\n";
echo "  organization_id: " . var_export($e->organization_id, true) . "\n";
echo "  date: {$e->date}\n";
