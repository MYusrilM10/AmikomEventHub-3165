<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Quick audit of what's in place
echo "=== SSO Configuration ===\n";
$socialite = class_exists('Laravel\Socialite\SocialiteServiceProvider');
echo "Socialite installed: " . ($socialite ? 'YES' : 'NO') . "\n";
echo "Google config (services.php): " . (config('services.google') ? 'YES' : 'NO') . "\n";

echo "\n=== Multi-Tenant ===\n";
echo "Organizations: " . App\Models\Organization::count() . "\n";
echo "Users with org memberships: " . DB::table('organization_user')->count() . "\n";
echo "Payouts: " . App\Models\Payout::count() . "\n";

echo "\n=== Reviews ===\n";
echo "Total reviews: " . App\Models\Review::count() . "\n";
echo "Active reviews: " . App\Models\Review::whereNull('deleted_at')->count() . "\n";
echo "Review invitations sent: " . App\Models\Transaction::whereNotNull('review_email_sent_at')->count() . "\n";
echo "Pending review invitations: " . App\Models\Transaction::whereNull('review_email_sent_at')->whereIn('status', ['success', 'settlement'])->count() . "\n";
echo "Review template (email): " . (file_exists(resource_path('views/emails/review-invitation.blade.php')) ? 'YES' : 'NO') . "\n";
echo "Public review form: " . (file_exists(resource_path('views/reviews/public.blade.php')) ? 'YES' : 'NO') . "\n";
echo "ReviewInvitationService: " . (file_exists(app_path('Services/ReviewInvitationService.php')) ? 'YES' : 'NO') . "\n";
echo "Review Mailable: " . (file_exists(app_path('Mail/ReviewInvitationMail.php')) ? 'YES' : 'NO') . "\n";
echo "Scheduled command: " . (file_exists(app_path('Console/Commands/SendDailyReviewInvitations.php')) ? 'YES' : 'NO') . "\n";
echo "Lazy middleware: " . (file_exists(app_path('Http/Middleware/TriggerPendingReviewEmails.php')) ? 'YES' : 'NO') . "\n";

echo "\n=== Routes ===\n";
echo "SSO route /auth/google: " . (Route::has('auth.google') ? 'YES' : 'NO') . "\n";
echo "Public review /rate/{order_id}: " . (Route::has('review.public') ? 'YES' : 'NO') . "\n";
echo "Panitia login via /login: " . (Route::has('login') ? 'YES' : 'NO') . "\n";
