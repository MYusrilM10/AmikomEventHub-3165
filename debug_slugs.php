<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

foreach (App\Models\Category::all() as $c) {
    echo $c->id . ' | ' . $c->name . ' | slug:' . $c->slug . PHP_EOL;
}
