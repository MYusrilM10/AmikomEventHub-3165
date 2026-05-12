@extends('layouts.admin')
@section('content')
<div class="p-8 bg-gradient-to-br from-slate-50 to-slate-100 min-h-screen">
    <!-- Header -->
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-800">Tambah Partner Baru</h2>
        <p class="text-gray-500 text-sm mt-1">Daftarkan partner baru ke dalam sistem</p>
    </div>

    <!-- Alert Error -->
    @if($errors->any())
        <div class="bg-gradient-to-r from-red-50 to-rose-50 text-red-700 p-4 rounded-lg mb-6 border border-red-200 shadow-sm">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
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
        <form action="{{ route('admin.partners.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Nama Partner -->
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                    Nama Partner <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name') }}"
                    placeholder="Masukkan nama partner"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition @error('name') border-red-500 @enderror"
                    required
                >
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Logo URL -->
            <div>
                <label for="logo_url" class="block text-sm font-semibold text-gray-700 mb-2">
                    URL Logo <span class="text-red-500">*</span>
                </label>
                <input 
                    type="url" 
                    id="logo_url" 
                    name="logo_url" 
                    value="{{ old('logo_url') }}"
                    placeholder="Contoh: https://placehold.co/200x200"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition @error('logo_url') border-red-500 @enderror"
                    required
                >
                @error('logo_url')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-xs mt-1">Masukkan URL lengkap logo partner (contoh: https://example.com/logo.png)</p>
            </div>

            <!-- Preview Logo -->
            <div id="logoPreview" style="display: none;">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Preview Logo</label>
                <div class="w-32 h-32 border-2 border-dashed border-gray-300 rounded-lg overflow-hidden flex items-center justify-center bg-gray-50">
                    <img id="previewImage" src="" alt="Preview" class="w-full h-full object-contain">
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex gap-3 pt-4">
                <button 
                    type="submit" 
                    class="flex-1 bg-gradient-to-r from-indigo-600 to-indigo-700 text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg hover:from-indigo-700 hover:to-indigo-800 transition-all duration-300 transform hover:scale-105"
                >
                    <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></path></svg>
                    Simpan Partner
                </button>
                <a 
                    href="{{ route('admin.partners.index') }}" 
                    class="flex-1 bg-gray-300 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-400 transition-all duration-300 text-center"
                >
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    // Preview logo ketika URL diisi
    const logoInput = document.getElementById('logo_url');
    const previewDiv = document.getElementById('logoPreview');
    const previewImage = document.getElementById('previewImage');

    logoInput.addEventListener('change', function() {
        if (this.value) {
            previewImage.src = this.value;
            previewImage.onload = function() {
                previewDiv.style.display = 'block';
            };
            previewImage.onerror = function() {
                previewDiv.style.display = 'none';
            };
        } else {
            previewDiv.style.display = 'none';
        }
    });

    // Load preview jika ada value awal
    if (logoInput.value) {
        previewImage.src = logoInput.value;
        previewImage.onload = function() {
            previewDiv.style.display = 'block';
        };
    }
</script>
@endsection
