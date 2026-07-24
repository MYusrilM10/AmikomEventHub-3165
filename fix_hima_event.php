<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Organization;
use App\Models\Event;

// Cari HIMA SI
$hima = Organization::where('name', 'like', '%HIMA%Sistem%Informasi%')->first();
if (! $hima) {
    $hima = Organization::where('slug', 'hima-si')->first();
}
if (! $hima) {
    // list semua org
    echo "HIMA SI not found. Available orgs:\n";
    foreach (Organization::all() as $o) {
        echo "  - id:{$o->id} | {$o->name} | slug:{$o->slug}\n";
    }
    exit(1);
}
echo "Found: id:{$hima->id} | {$hima->name} | slug:{$hima->slug}\n\n";

// Event Blockchain
$bc = Event::where('title', 'like', '%Blockchain%')->first();
if (! $bc) {
    echo "Blockchain event not found\n";
    exit(1);
}
echo "Event: id:{$bc->id} | {$bc->title} | current org_id:" . var_export($bc->organization_id, true) . " | date:{$bc->date}\n";

// Fix
$bc->organization_id = $hima->id;
$bc->save();
echo "\nUpdated event org_id to {$hima->id}\n";

// Verify
$bc->refresh();
echo "Now org: " . $bc->organization->name . " (id:{$bc->organization->id})\n";
echo "Events of HIMA SI now: " . $hima->fresh()->events()->count() . "\n";
