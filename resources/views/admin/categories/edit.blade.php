@extends('layouts.admin')

@section('content')

<div class="p-8 bg-gradient-to-br from-slate-50 to-slate-100 min-h-screen">

    <!-- Header -->
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-800">Edit Kategori</h2>
        <p class="text-gray-500 text-sm mt-1">Perbarui informasi kategori di bawah ini</p>
    </div>

    <!-- Alert Error -->
    @if($errors->any())
        <div class="bg-gradient-to-r from-red-50 to-rose-50 text-red-700 p-4 rounded-lg mb-6 border border-red-200 shadow-sm">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <div>
                    <h3 class="font-semibold mb-2">Terjadi Kesalahan:</h3>
                    <ul class="text-sm space-y-1 list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <!-- Form Container -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-8 max-w-2xl">
        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Nama Kategori -->
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                    Nama Kategori <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name', $category->name) }}"
                    placeholder="Contoh: Musik, Workshop, Olahraga, dll"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition @error('name') border-red-500 @enderror"
                    required
                >
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Popularitas -->
            <div>
                <label for="popularity" class="block text-sm font-semibold text-gray-700 mb-2">
                    Badge Popularitas <span class="text-red-500">*</span>
                </label>
                <select 
                    id="popularity" 
                    name="popularity"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition @error('popularity') border-red-500 @enderror"
                    required
                >
                    <option value="" disabled>-- Pilih Popularitas --</option>
                    <option value="Trending" @selected(old('popularity', $category->popularity) === 'Trending')>Trending</option>
                    <option value="Popular" @selected(old('popularity', $category->popularity) === 'Popular')>Popular</option>
                    <option value="New" @selected(old('popularity', $category->popularity) === 'New')>New</option>
                </select>
                @error('popularity')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tanggal Dibuat -->
            <div>
                <label for="created_at" class="block text-sm font-semibold text-gray-700 mb-2">
                    Tanggal Dibuat <span class="text-red-500">*</span>
                </label>
                <input 
                    type="date" 
                    id="created_at" 
                    name="created_at" 
                    value="{{ old('created_at', $category->created_at->format('Y-m-d')) }}"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition @error('created_at') border-red-500 @enderror"
                    required
                >
                @error('created_at')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-xs mt-1">Ubah tanggal jika diperlukan</p>
            </div>

            <!-- Buttons -->
            <div class="flex gap-3 pt-4">
                <button 
                    type="submit" 
                    class="flex-1 bg-gradient-to-r from-indigo-600 to-indigo-700 text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg hover:from-indigo-700 hover:to-indigo-800 transition-all duration-300 transform hover:scale-105"
                >
                    <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Update Kategori
                </button>
                <a 
                    href="{{ route('admin.categories.index') }}" 
                    class="flex-1 bg-gray-300 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-400 transition-all duration-300 text-center"
                >
                    Batal
                </a>
            </div>
        </form>
    </div>

</div>

@endsection
