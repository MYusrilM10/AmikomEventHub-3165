@extends('layouts.app')

@section('content')
    <main class="max-w-3xl mx-auto px-6 py-20">
        <div class="mb-12">
            <a href="{{ route('events.show', $event->id) }}" class="text-indigo-600 font-bold flex items-center gap-2 mb-6">
                <i class="fa-solid fa-chevron-left w-4 h-4"></i>
                Kembali ke Event
            </a>
            <h1 class="text-4xl font-extrabold">Checkout</h1>
            <p class="text-slate-500 mt-2">Lengkapi data Anda untuk mendapatkan tiket.</p>
        </div>

        <div class="grid grid-cols-1 gap-8">
            {{-- Summary Card --}}
            <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm">
                <h3 class="text-xl font-bold mb-6 border-b pb-4">Pesanan Anda</h3>
                <div class="flex gap-6 items-start">
                    <img src="{{ $event->poster_path ? asset('storage/' . $event->poster_path) : asset('assets/concert.png') }}" alt="{{ $event->title }}" class="w-24 h-24 rounded-2xl object-cover">
                    <div>
                        <h4 class="font-extrabold text-lg">{{ $event->title }}</h4>
                        <p class="text-slate-500">{{ \Carbon\Carbon::parse($event->date)->format('d M Y') }} • {{ $event->location }}</p>
                        <p class="text-indigo-600 font-bold mt-2">1 x Rp {{ number_format($event->price, 0, ',', '.') }}</p>
                    </div>
                </div>
                <div class="mt-8 pt-6 border-t space-y-3">
                    <div class="flex justify-between text-slate-500">
                        <span>Harga Tiket</span>
                        <span>Rp {{ number_format($event->price, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-slate-500">
                        <span>Biaya Layanan</span>
                        <span>Rp 5.000</span>
                    </div>
                    <div class="flex justify-between text-2xl font-black mt-4 pt-4 border-t">
                        <span>Total Bayar</span>
                        <span class="text-indigo-600">Rp {{ number_format($event->price + 5000, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            {{-- Form Card --}}
            <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm">
                <h3 class="text-xl font-bold mb-6 italic text-indigo-600 underline underline-offset-8">
                    <i class="fa-solid fa-user-circle w-5 h-5"></i> Data Pemesan
                </h3>

                {{-- Tombol Login Cepat via Google (SSO) --}}
                <a href="{{ route('auth.google', ['event_id' => $event->id]) }}"
                   class="w-full flex items-center justify-center gap-3 bg-white border-2 border-slate-200 hover:border-indigo-600 hover:shadow-lg text-slate-700 font-bold py-3.5 rounded-2xl transition-all mb-4">
                    <svg class="w-5 h-5" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                        <path fill="#FFC107" d="M43.611 20.083H42V20H24v8h11.303c-1.649 4.657-6.08 8-11.303 8-6.627 0-12-5.373-12-12s5.373-12 12-12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.268 4 24 4 12.955 4 4 12.955 4 24s8.955 20 20 20 20-8.955 20-20c0-1.341-.138-2.65-.389-3.917z"/>
                        <path fill="#FF3D00" d="M6.306 14.691l6.571 4.819C14.655 15.108 18.961 12 24 12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.268 4 24 4 16.318 4 9.656 8.337 6.306 14.691z"/>
                        <path fill="#4CAF50" d="M24 44c5.166 0 9.86-1.977 13.409-5.192l-6.19-5.238C29.211 35.091 26.715 36 24 36c-5.202 0-9.619-3.317-11.283-7.946l-6.522 5.025C9.505 39.556 16.227 44 24 44z"/>
                        <path fill="#1976D2" d="M43.611 20.083H42V20H24v8h11.303c-.792 2.237-2.231 4.166-4.087 5.571.001-.001.002-.001.003-.002l6.19 5.238C36.971 39.205 44 34 44 24c0-1.341-.138-2.65-.389-3.917z"/>
                    </svg>
                    <span>Continue with Google</span>
                </a>

                {{-- Divider --}}
                <div class="flex items-center gap-3 my-5">
                    <div class="flex-1 h-px bg-slate-200"></div>
                    <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">
                        atau isi manual di bawah
                    </span>
                    <div class="flex-1 h-px bg-slate-200"></div>
                </div>

                <form action="{{ route('checkout.store', $event->id) }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Nama
                            Lengkap</label>
                        <input type="text" name="customer_name" placeholder="Masukkan nama sesuai identitas"
                            class="w-full px-5 py-4 bg-white border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 outline-none transition font-medium"
                            required
                            value="{{ old('customer_name', auth()->check() ? auth()->user()->name : '') }}">
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Email
                                Aktif</label>
                            <input type="email" name="customer_email" placeholder="contoh@gmail.com"
                                class="w-full px-5 py-4 bg-white border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 outline-none transition font-medium"
                                required
                                value="{{ old('customer_email', auth()->check() ? auth()->user()->email : '') }}">
                            <p class="text-[10px] text-slate-400 mt-2 font-bold uppercase tracking-tighter">*E-Ticket
                                akan dikirim ke email ini</p>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">No.
                                WhatsApp</label>
                            <input type="tel" name="customer_phone" placeholder="08xxxxxxx"
                                class="w-full px-5 py-4 bg-white border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 outline-none transition font-medium"
                                required>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full py-5 bg-indigo-600 text-white rounded-2xl font-black text-xl shadow-xl shadow-indigo-200 hover:bg-indigo-700 active:scale-95 transition-all flex items-center justify-center gap-2">
                        <i class="fa-solid fa-credit-card w-5 h-5"></i>
                        Bayar Sekarang
                    </button>
                    <p class="text-center text-xs text-slate-400">Dengan menekan tombol di atas, Anda menyetujui Syarat
                        & Ketentuan kami.</p>
                </form>
            </div>
        </div>
    </main>

    {{-- Overlay Midtrans Simulation --}}
    <div id="midtrans-overlay"
        class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-6">
        <div class="bg-white w-full max-w-sm rounded-[2rem] overflow-hidden shadow-2xl">
            <div class="bg-slate-50 p-6 flex justify-between items-center border-b">
                <span class="font-black text-slate-800 tracking-tight"><i class="fa-solid fa-lock w-5 h-5 mr-2"></i>Midtrans Payment</span>
                <button onclick="hideMidtrans()" class="p-2 hover:bg-slate-200 rounded-full">
                    <i class="fa-solid fa-xmark w-5 h-5"></i>
                </button>
            </div>
            <div class="p-8 text-center">
                <p class="text-slate-500 font-medium">Total Tagihan</p>
                <h2 class="text-3xl font-black text-indigo-700 my-2">Rp 155.000</h2>
                <p class="text-xs text-slate-400">Order ID #TRX-99210</p>

                <div class="mt-8 space-y-4">
                    <button onclick="window.location.href='{{ route('ticket') }}'"
                        class="w-full py-4 border-2 border-indigo-100 rounded-2xl flex justify-between items-center px-6 hover:border-indigo-600 transition group">
                        <span class="font-bold group-hover:text-indigo-600">GoPay / QRIS</span>
                        <span class="text-indigo-400">→</span>
                    </button>
                    <button
                        class="w-full py-4 border-2 border-indigo-100 rounded-2xl flex justify-between items-center px-6 opacity-50 cursor-not-allowed">
                        <span class="font-bold">Virtual Account (BNI, BRI)</span>
                        <span class="text-indigo-400">→</span>
                    </button>
                    <button
                        class="w-full py-4 border-2 border-indigo-100 rounded-2xl flex justify-between items-center px-6 opacity-50 cursor-not-allowed">
                        <span class="font-bold">Kartu Debit/Kredit</span>
                        <span class="text-indigo-400">→</span>
                    </button>
                </div>

                <div class="mt-12 flex items-center justify-center gap-2 text-xs text-slate-400 font-bold uppercase tracking-widest">
                    <i class="fa-solid fa-lock w-4 h-4"></i>
                    Secure Checkout by Midtrans
                </div>
            </div>
        </div>
    </div>

    <script>
        function showMidtrans() {
            const overlay = document.getElementById('midtrans-overlay');
            overlay.classList.remove('hidden');
            overlay.classList.add('flex');
        }
        function hideMidtrans() {
            const overlay = document.getElementById('midtrans-overlay');
            overlay.classList.add('hidden');
            overlay.classList.remove('flex');
        }
    </script>

    <style>
        @keyframes bounce-in {
            0% { transform: scale(0.9); opacity: 0; }
            70% { transform: scale(1.05); opacity: 1; }
            100% { transform: scale(1); }
        }
        .animate-bounce-in { animation: bounce-in 0.4s ease-out forwards; }
    </style>
@endsection