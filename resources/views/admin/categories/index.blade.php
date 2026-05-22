@extends('layouts.admin')

@section('content')

<div class="p-8 bg-gradient-to-br from-slate-50 to-slate-100 min-h-screen">

    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-bold text-gray-800">Manajemen Kategori</h2>
            <p class="text-gray-500 text-sm mt-1">Kelola semua kategori event Anda di sini</p>
        </div>
        <a href="{{ route('admin.categories.create') }}" 
           class="bg-gradient-to-r from-indigo-600 to-indigo-700 text-white px-6 py-2.5 rounded-lg font-semibold hover:shadow-lg hover:from-indigo-700 hover:to-indigo-800 transition-all duration-300 transform hover:scale-105">
            + Tambah Kategori
        </a>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
        <div class="bg-gradient-to-r from-green-50 to-emerald-50 text-green-700 p-4 rounded-lg mb-6 border border-green-200 shadow-sm flex items-center gap-3">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Search Form -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 mb-6">
        <form action="{{ route('admin.categories.index') }}" method="GET" class="flex gap-3">
            <div class="flex-1">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}"
                    placeholder="Cari kategori berdasarkan nama..."
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition"
                >
            </div>
            <button 
                type="submit" 
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2.5 rounded-lg font-semibold transition-all duration-300"
            >
                <svg class="w-5 h-5 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                Cari
            </button>
            @if(request('search'))
                <a 
                    href="{{ route('admin.categories.index') }}" 
                    class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-2.5 rounded-lg font-semibold transition-all duration-300"
                >
                    Reset
                </a>
            @endif
        </form>
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
        <div class="overflow-x-auto">
            <table class="w-full">
                <!-- Table Head -->
                <thead>
                    <tr class="bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">No</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">Nama Kategori</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">Badge Popularitas</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">Dibuat</th>
                        <th class="px-6 py-4 text-center text-sm font-bold text-gray-700 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>

                <!-- Table Body -->
                <tbody class="divide-y divide-gray-200">
                    @forelse($categories as $index => $category)
                        <tr class="hover:bg-gradient-to-r hover:from-indigo-50 hover:to-blue-50 transition-colors duration-200 group">
                            <!-- No -->
                            <td class="px-6 py-4">
                                <span class="text-gray-700 font-semibold">{{ $loop->iteration }}</span>
                            </td>
                            <!-- Nama -->
                            <td class="px-6 py-4">
                                <div class="font-semibold text-gray-800 group-hover:text-indigo-600 transition">
                                    {{ $category->name }}
                                </div>
                            </td>
                            <!-- Badge Popularitas -->
                            <td class="px-6 py-4">
                                <x-popularity-badge :popularity="$category->popularity" />
                            </td>
                            <!-- Dibuat -->
                            <td class="px-6 py-4">
                                <span class="text-gray-600 text-sm">
                                    {{ $category->created_at->format('d M Y') }}
                                </span>
                            </td>
                            <!-- Tombol Aksi -->
                            <td class="px-6 py-4">
                                <div class="flex gap-2 justify-center">
                                    <!-- Edit -->
                                    <a href="{{ route('admin.categories.edit', $category->id) }}"
                                       class="inline-flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-blue-700 hover:shadow-md transition-all duration-200 transform hover:scale-105">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        Edit
                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                          method="POST"
                                          class="inline"
                                          onsubmit="return confirm('Anda yakin ingin menghapus kategori ini secara permanen?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center gap-2 bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-red-700 hover:shadow-md transition-all duration-200 transform hover:scale-105">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                    <p class="text-gray-500 font-medium text-lg">
                                        Belum ada data kategori
                                    </p>
                                    <p class="text-gray-400 text-sm mt-1">
                                        @if(request('search'))
                                            Hasil pencarian tidak ditemukan. Coba istilah pencarian lain.
                                        @else
                                            Silakan tambah kategori baru untuk memulai
                                        @endif
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if($categories->hasPages())
        <div class="mt-6">
            {{ $categories->links() }}
        </div>
    @endif

</div>

@endsection