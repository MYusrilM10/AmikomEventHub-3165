<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    /**
     * Redirect user ke halaman OAuth Google.
     */
    public function redirect(Request $request)
    {
        // Simpan event_id ke session agar setelah callback balik ke checkout event yang sama
        if ($request->has('event_id')) {
            session(['checkout_event_id' => $request->event_id]);
        }
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle callback setelah user authorize di Google.
     */
    public function callback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            Log::error('Google SSO error: ' . $e->getMessage());
            return redirect()->route('home')
                ->with('error', 'Login Google gagal atau dibatalkan. Silakan coba lagi.');
        }

        // Validasi email
        if (empty($googleUser->getEmail())) {
            return redirect()->route('home')
                ->with('error', 'Tidak bisa mendapatkan email dari akun Google Anda.');
        }

        // Cari user berdasarkan google_id, kalau tidak ada cari berdasarkan email
        $user = User::where('google_id', $googleUser->getId())->first();

        if (!$user) {
            $user = User::where('email', $googleUser->getEmail())->first();
        }

        // Buat user baru jika belum ada
        if (!$user) {
            $user = User::create([
                'name'      => $googleUser->getName()  ?? $googleUser->getNickname() ?? 'User',
                'email'     => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'avatar'    => $googleUser->getAvatar(),
                'password'  => null, // user SSO tidak punya password
                'role'      => 'user',
            ]);
        } else {
            // Update google_id & avatar (jika login pertama kali dengan Google)
            $user->update([
                'google_id' => $googleUser->getId(),
                'avatar'    => $googleUser->getAvatar(),
            ]);
        }

        // Login user (remember = true)
        Auth::login($user, true);

        // Redirect ke intended URL, atau ke halaman checkout event yang tadi dibuka
        $intended = session('checkout_event_id')
            ? route('checkout.create', ['event' => session('checkout_event_id')])
            : route('home');

        // Hapus session checkout_event_id setelah dipakai
        session()->forget('checkout_event_id');

        return redirect()->intended($intended)
            ->with('success', 'Halo ' . $user->name . '! Login berhasil via Google.');
    }
}
