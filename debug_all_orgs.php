<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Organization;
use App\Models\Event;

echo "=== ALL ORGANIZATIONS ===\n";
foreach (Organization::all() as $o) {
    $eventCount = $o->events()->count();
    echo "id:{$o->id} | slug:{$o->slug} | name:{$o->name} | events:{$eventCount}\n";
    if ($eventCount > 0 && $eventCount <= 10) {
        foreach ($o->events()->get() as $e) {
            echo "    - [{$e->id}] {$e->title} | date:{$e->date} | org_id:{$e->organization_id}\n";
        }
    }
}

echo "\n=== ALL EVENTS (showing org_id vs expected) ===\n";
foreach (Event::all() as $e) {
    $orgName = $e->organization?->name ?? 'NO ORG';
    echo "[{$e->id}] {$e->title} | org_id:{$e->organization_id} | resolved:{$orgName}\n";
}
