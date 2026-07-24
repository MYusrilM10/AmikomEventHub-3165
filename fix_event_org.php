<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$updated = App\Models\Event::where('id', 9)->update(['organization_id' => 3]);
echo "Updated event 9. Rows: $updated\n";
$e = App\Models\Event::find(9);
echo "Now organization_id = " . var_export($e->organization_id, true) . "\n";
echo "Org name: " . ($e->organization?->name ?? 'NULL') . "\n";
