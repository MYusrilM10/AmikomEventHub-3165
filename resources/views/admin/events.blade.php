@extends('layouts.admin')

@section('content')
    <header class="flex justify-between items-center mb-10">
        <div>
            <h1 class="text-3xl font-black">Kelola Event</h1>
            <p class="text-slate-500 font-medium">Buat dan atur acara seru Anda di sini.</p>
        </div>
        <a href="{{ route('admin.events.create') }}"
            class="px-6 py-3 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 active:scale-95 transition flex items-center gap-2">
            <i class="fa-solid fa-plus w-5 h-5"></i>
            Tambah Event Baru
        </a>
    </header>

    <!-- Alert Success -->
    @if(session('success'))
        <div class="bg-gradient-to-r from-green-50 to-emerald-50 text-green-700 p-4 rounded-lg mb-6 border border-green-200 shadow-sm flex items-center gap-3">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-lg overflow-hidden">
        <div class="px-8 py-6 bg-gradient-to-r from-indigo-50 to-indigo-100 border-b border-indigo-200 flex gap-4">
            <form action="{{ route('admin.events.index') }}" method="GET" class="flex gap-3 flex-1">
                <input type="text" name="search" placeholder="Cari nama event atau lokasi..." value="{{ request('search') }}"
                    class="flex-1 px-5 py-3 rounded-xl border-slate-200 border bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition">
                <select name="category" class="px-5 py-3 rounded-xl border-slate-200 border bg-white outline-none focus:ring-2 focus:ring-indigo-500 transition" onchange="this.form.submit()">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-semibold transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </button>
                @if(request('search') || request('category'))
                    <a href="{{ route('admin.events.index') }}" class="px-6 py-3 bg-gray-300 hover:bg-gray-400 text-gray-700 rounded-xl font-semibold transition-all duration-300">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gradient-to-r from-indigo-600 to-indigo-700 text-white uppercase text-[10px] font-black tracking-widest">
                    <tr>
                        <th class="px-8 py-4 w-16">No</th>
                        <th class="px-8 py-4">Poster</th>
                        <th class="px-8 py-4">Event</th>
                        <th class="px-8 py-4">Harga / Stok</th>
                        <th class="px-8 py-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 border-t border-slate-200">
                    @forelse($events as $index => $event)
                        <tr class="hover:bg-indigo-50/50 transition">
                            <td class="px-8 py-6 font-bold text-slate-500">{{ $loop->iteration }}</td>
                            <td class="px-8 py-6">
                                <img src="{{ asset('assets/concert.png') }}" class="w-16 h-20 rounded-xl object-cover shadow-sm">
                            </td>
                            <td class="px-8 py-6">
                                <p class="font-black text-slate-800">{{ $event->title }}</p>
                                <p class="text-xs text-slate-400">{{ $event->category->name }} • {{ $event->date }}</p>
                            </td>
                            <td class="px-8 py-6">
                                <p class="font-bold text-indigo-600">Rp {{ number_format($event->price, 0, ',', '.') }}</p>
                                <p class="text-xs text-slate-400">Stok: {{ $event->stock }}</p>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.events.edit', $event->id) }}"
                                        class="p-2.5 bg-indigo-50 text-indigo-600 rounded-xl hover:bg-indigo-600 hover:text-white transition">
                                        <i class="fa-solid fa-pen-to-square w-5 h-5 text-center leading-5 relative top-0.5"></i>
                                    </a>
                                    <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="inline" onsubmit="return confirm('Anda yakin ingin menghapus event ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="p-2.5 bg-rose-50 text-rose-600 rounded-xl hover:bg-rose-600 hover:text-white transition">
                                            <i class="fa-solid fa-trash w-5 h-5 text-center leading-5 relative top-0.5"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-8 py-12 text-center">
                                <p class="text-gray-500 font-medium">Belum ada data event</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($events->hasPages())
            <div class="px-8 py-6 border-t border-slate-200">
                {{ $events->links() }}
            </div>
        @endif
    </div>
@endsection