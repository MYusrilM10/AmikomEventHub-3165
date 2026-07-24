<?php
// One-off helper to promote a user to admin. Run from CLI:
//   C:\xampp\php\php.exe c:\xampp\htdocs\3165_P3\laravel-app\promote_admin.php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$email = $argv[1] ?? null;
if ($email) {
    $u = App\Models\User::where('email', $email)->first();
} else {
    $u = App\Models\User::orderBy('id')->first();
}
if (! $u) {
    echo "No user found\n";
    exit(1);
}
$u->role = 'superadmin';
$u->save();
echo $u->email . ' is now ' . $u->role . PHP_EOL;
