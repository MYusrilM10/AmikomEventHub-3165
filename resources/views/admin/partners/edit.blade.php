@extends('layouts.admin')

@section('content')

<div class="p-8 bg-gradient-to-br from-slate-50 to-slate-100 min-h-screen">

    <!-- Header -->
    <div class="mb-8">

        <h2 class="text-3xl font-bold text-gray-800">
            Edit Partner
        </h2>

        <p class="text-gray-500 text-sm mt-1">
            Perbarui informasi partner di bawah ini
        </p>

    </div>



    <!-- Card Form -->
    <div class="max-w-2xl bg-white rounded-2xl shadow-lg border border-gray-100 p-8">

        <form action="{{ route('admin.partners.update', $partner->id) }}"
              method="POST"
              class="space-y-6">

            @csrf
            @method('PUT')



            <!-- Nama Partner -->
            <div>

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Nama Partner
                </label>

                <input type="text"
                       name="name"
                       value="{{ $partner->name }}"
                       placeholder="Masukkan nama partner"
                       class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">

            </div>



            <!-- Logo URL -->
            <div>

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Logo URL <span class="text-red-500">*</span>
                </label>

                <input type="url"
                       id="logo_url"
                       name="logo_url"
                       value="{{ $partner->logo_url }}"
                       placeholder="https://example.com/logo.png"
                       class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition"
                       required>

                <p class="text-gray-500 text-xs mt-1">Masukkan URL lengkap logo partner (contoh: https://example.com/logo.png)</p>

            </div>



            <!-- Preview Logo - Real-time update -->
            <div id="logoPreview">

                <label class="block text-sm font-semibold text-gray-700 mb-3">
                    Preview Logo
                </label>

                <div class="w-32 h-32 border-2 border-dashed border-gray-300 rounded-lg overflow-hidden flex items-center justify-center bg-gray-50">
                    <img id="previewImage" 
                         src="{{ $partner->logo_url }}"
                         alt="{{ $partner->name }}"
                         class="w-full h-full object-contain">
                </div>

            </div>



            <!-- Button -->
            <div class="flex items-center gap-4 pt-4">

                <!-- Update -->
                <button type="submit"
                        class="bg-gradient-to-r from-indigo-600 to-indigo-700 text-white px-6 py-3 rounded-xl font-semibold hover:shadow-lg hover:from-indigo-700 hover:to-indigo-800 transition-all duration-300">

                    Update Partner

                </button>



                <!-- Kembali -->
                <a href="{{ route('admin.partners.index') }}"
                   class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-3 rounded-xl font-semibold transition">

                    Kembali

                </a>

            </div>

        </form>

    </div>

</div>

<script>
    // Real-time preview logo saat URL diubah
    const logoInput = document.getElementById('logo_url');
    const previewImage = document.getElementById('previewImage');
    const logoPreview = document.getElementById('logoPreview');

    // Function untuk update preview
    function updatePreview() {
        const url = logoInput.value.trim();
        
        if (url) {
            previewImage.src = url;
            // Tampilkan preview container
            logoPreview.style.display = 'block';
            
            // Handle error jika URL tidak valid
            previewImage.onerror = function() {
                console.warn('Gagal memuat gambar dari URL:', url);
            };
        } else {
            logoPreview.style.display = 'none';
        }
    }

    // Trigger on 'input' event untuk real-time preview saat user mengetik
    logoInput.addEventListener('input', updatePreview);

    // Juga handle 'change' event untuk jaga-jaga
    logoInput.addEventListener('change', updatePreview);
</script>

@endsection