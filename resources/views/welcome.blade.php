@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="max-w-7xl mx-auto px-6 py-20 flex flex-col md:flex-row items-center gap-12">
        <div class="flex-1 space-y-8">
            <span
                class="inline-block px-4 py-1.5 bg-indigo-100 text-indigo-700 rounded-full text-sm font-bold uppercase tracking-wider">
                #1 Event Platform
            </span>
            <h1 class="text-5xl md:text-7xl font-extrabold leading-tight">
                Temukan & Pesan <span class="text-indigo-600">Tiket Event</span> Impianmu.
            </h1>
            <p class="text-lg text-slate-500 max-w-lg leading-relaxed">
                Dari konser musik hingga workshop teknologi, semua ada di genggamanmu. Pesan aman & cepat dengan
                Midtrans.
            </p>
            <div class="flex gap-4">
                <a href="#events"
                    class="px-8 py-4 bg-indigo-600 text-white rounded-2xl font-bold text-lg shadow-xl shadow-indigo-200 hover:scale-105 transition-transform flex items-center gap-2">
                    <i class="fa-solid fa-arrow-right w-5 h-5"></i>
                    Mulai Jelajah
                </a>
                <a href="#"
                    class="px-8 py-4 border-2 border-slate-200 rounded-2xl font-bold text-lg hover:border-indigo-600 hover:text-indigo-600 transition flex items-center gap-2">
                    <i class="fa-solid fa-circle-info w-5 h-5"></i>
                    Cara Pesan
                </a>
            </div>
        </div>
        <div class="flex-1 relative">
            <div
                class="absolute -top-10 -left-10 w-64 h-64 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob">
            </div>
            <div
                class="absolute -bottom-10 -right-10 w-64 h-64 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000">
            </div>
            <img src="{{ asset('assets/hackathon.png') }}" alt="hackathon"
                class="rounded-[2rem] shadow-2xl relative z-10 w-full object-cover aspect-[4/5] object-center">

            <div class="absolute -bottom-6 -left-6 glass p-6 rounded-2xl shadow-xl z-20 border border-white">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-green-600">
                        <i class="fa-solid fa-check text-xl"></i>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 font-bold uppercase">Terverifikasi</p>
                        <p class="font-bold">Pembayaran Aman via Midtrans</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Events Grid -->
    <section id="events" class="max-w-7xl mx-auto px-6 py-20">
        <div class="mb-12">
            <div class="mb-8">
                <h2 class="text-3xl font-extrabold mb-2">Event Terdekat</h2>
                <p class="text-slate-500 font-medium">Jangan sampai ketinggalan acara seru minggu ini!</p>
            </div>

            <!-- Category Filter Buttons -->
            <div class="flex flex-wrap gap-2.5 items-center">
                @php
                    $isActiveAll = !request('category');
                @endphp
                <a href="/"
                    class="inline-flex items-center px-6 py-3 font-semibold text-sm tracking-wide rounded-2xl transition-all duration-300 transform whitespace-nowrap focus:outline-none focus:ring-2 focus:ring-offset-2 leading-none
                    {{ $isActiveAll 
                        ? 'bg-gradient-to-r from-indigo-600 to-indigo-700 text-white shadow-lg shadow-indigo-200 hover:shadow-xl hover:shadow-indigo-300 hover:-translate-y-1' 
                        : 'bg-white text-slate-600 border border-slate-300 hover:border-indigo-400 hover:shadow-md hover:text-indigo-600 hover:-translate-y-0.5' 
                    }}">
                    <span>Semua</span>
                </a>
                @foreach($categories as $cat)
                    @php
                        $isActive = request('category') === $cat->slug;
                    @endphp
                    <a href="?category={{ $cat->slug }}"
                        class="inline-flex items-center px-6 py-3 font-semibold text-sm tracking-wide rounded-2xl transition-all duration-300 transform whitespace-nowrap focus:outline-none focus:ring-2 focus:ring-offset-2 leading-none
                        {{ $isActive 
                            ? 'bg-gradient-to-r from-indigo-600 to-indigo-700 text-white shadow-lg shadow-indigo-200 hover:shadow-xl hover:shadow-indigo-300 hover:-translate-y-1' 
                            : 'bg-white text-slate-600 border border-slate-300 hover:border-indigo-400 hover:shadow-md hover:text-indigo-600 hover:-translate-y-0.5' 
                        }}">
                        <span>{{ $cat->name }}</span>
                    </a>
                @endforeach
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($events as $event)
                <div class="group bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-2xl transition-all duration-300 overflow-hidden">
                    <div class="relative overflow-hidden aspect-[3/4]">
                        <img src="https://placehold.co/200x600" alt="{{ $event->title }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 left-4 px-3 py-1 bg-white/90 backdrop-blur rounded-lg text-xs font-bold uppercase text-indigo-600">
                            {{ $event->category->name }}
                        </div>
                    </div>

                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2 group-hover:text-indigo-600 transition">
                            {{ $event->title }}
                        </h3>

                        <div class="flex items-center gap-2 text-slate-500 text-sm mb-4">
                            <i class="fa-solid fa-clock w-4 h-4 text-center"></i>
                            <span>{{ $event->date }}</span>
                        </div>

                        <div class="flex justify-between items-center pt-4 border-t">
                            <span class="text-2xl font-black text-indigo-600">
                                Rp {{ number_format($event->price, 0, ',', '.') }}
                            </span>

                            <a href="{{ route('events.show', $event->id) }}"
                                class="px-5 py-2 bg-indigo-50 text-indigo-600 rounded-xl font-bold hover:bg-indigo-600 hover:text-white transition flex items-center gap-2">
                                <i class="fa-solid fa-eye w-4 h-4"></i>
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Partners Section -->
    @if($partners->count() > 0)
        <section class="max-w-7xl mx-auto px-6 py-24">
            <!-- Decorative background elements -->
            <div class="absolute left-0 top-1/2 -z-10 w-96 h-96 bg-indigo-100 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob"></div>
            <div class="absolute right-0 top-1/3 -z-10 w-96 h-96 bg-purple-100 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob animation-delay-4000"></div>

            <!-- Section Header -->
            <div class="mb-16 text-center">
                <div class="inline-block mb-4">
                    <span class="inline-flex items-center px-4 py-2 bg-indigo-50 text-indigo-600 rounded-full text-xs font-bold uppercase tracking-widest border border-indigo-100">
                        <span class="w-2 h-2 bg-indigo-600 rounded-full mr-2"></span>
                        Mitra Terpercaya
                    </span>
                </div>
                <h2 class="text-4xl md:text-5xl font-black mb-4 bg-gradient-to-r from-slate-900 to-slate-700 bg-clip-text text-transparent">
                    Partner & Sponsor Kami
                </h2>
                <p class="text-lg text-slate-500 max-w-2xl mx-auto leading-relaxed">
                    Dipercaya oleh perusahaan dan organisasi terkemuka di seluruh Indonesia untuk menyelenggarakan event yang memorable
                </p>
            </div>

            <!-- Partners Grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 lg:gap-8">
                @foreach($partners as $partner)
                    <div class="group relative h-32 lg:h-40 rounded-2xl overflow-hidden transition-all duration-500">
                        <!-- Card Background -->
                        <div class="absolute inset-0 bg-gradient-to-br from-white via-white to-slate-50 border border-slate-100 rounded-2xl shadow-sm group-hover:shadow-2xl transition-all duration-500"></div>
                        
                        <!-- Hover Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-br from-indigo-50/0 to-purple-50/0 group-hover:from-indigo-50/50 group-hover:to-purple-50/50 rounded-2xl transition-all duration-500 pointer-events-none"></div>
                        
                        <!-- Border Animation -->
                        <div class="absolute inset-0 rounded-2xl border border-transparent group-hover:border-indigo-200 transition-all duration-500"></div>

                        <!-- Content -->
                        <div class="relative h-full flex items-center justify-center p-6 lg:p-8">
                            @if($partner->logo_url)
                                <div class="flex items-center justify-center w-full h-full">
                                    <img 
                                        src="{{ $partner->logo_url }}" 
                                        alt="{{ $partner->name }}"
                                        class="max-h-24 max-w-full object-contain grayscale group-hover:grayscale-0 transition-all duration-500 group-hover:scale-110 drop-shadow-sm group-hover:drop-shadow-md"
                                        title="{{ $partner->name }}"
                                    >
                                </div>
                            @else
                                <div class="text-center">
                                    <div class="inline-flex items-center justify-center w-12 h-12 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-xl mb-2 group-hover:from-indigo-200 group-hover:to-purple-200 transition-colors duration-300">
                                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                        </svg>
                                    </div>
                                    <p class="text-slate-700 font-bold text-sm group-hover:text-indigo-600 transition-colors duration-300">
                                        {{ $partner->name }}
                                    </p>
                                </div>
                            @endif
                        </div>

                        <!-- Shine Effect -->
                        <div class="absolute inset-0 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none">
                            <div class="absolute inset-0 rounded-2xl bg-gradient-to-r from-transparent via-white to-transparent opacity-20 transform -translate-x-full group-hover:translate-x-full transition-transform duration-1000 pointer-events-none"></div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Bottom Accent -->
            <div class="mt-16 flex items-center justify-center">
                <div class="h-1 w-12 bg-gradient-to-r from-transparent to-indigo-400"></div>
                <p class="mx-4 text-slate-400 text-sm font-medium">Bersama membangun ekosistem event yang lebih baik</p>
                <div class="h-1 w-12 bg-gradient-to-l from-transparent to-indigo-400"></div>
            </div>
        </section>
    @endif

    <!-- Footer -->
    <footer class="bg-indigo-900 text-indigo-100 py-20 px-6 mt-20">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-12">
            <div class="space-y-4 col-span-2">
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-indigo-900 font-bold text-xl">
                        AH
                    </div>
                    <span class="text-2xl font-bold text-white">AmikomEventHub</span>
                </div>
                <p class="max-w-xs text-indigo-300">Platform reservasi tiket event online terbaik untuk mahasiswa dan penyelenggara profesional.</p>
            </div>
            <div>
                <h4 class="text-white font-bold mb-6">Navigasi</h4>
                <ul class="space-y-4">
                    <li><a href="#" class="hover:text-white transition">Home</a></li>
                    <li><a href="#" class="hover:text-white transition">Semua Event</a></li>
                    <li><a href="#" class="hover:text-white transition">Cara Bayar</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-bold mb-6">Hubungi Kami</h4>
                <ul class="space-y-4">
                    <li>support@eventtiket.com</li>
                    <li>+62 812 3456 7890</li>
                </ul>
            </div>
        </div>
        <div class="max-w-7xl mx-auto pt-12 mt-12 border-t border-indigo-800 text-center text-indigo-400 text-sm">
            &copy; 2024 AmikomEventHub. Built with Laravel & Tailwind CSS.
        </div>
    </footer>
@endsection