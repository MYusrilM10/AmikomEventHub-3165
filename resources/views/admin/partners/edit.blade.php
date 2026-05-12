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
                    Logo URL
                </label>

                <input type="text"
                       name="logo_url"
                       value="{{ $partner->logo_url }}"
                       placeholder="https://example.com/logo.png"
                       class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">

            </div>



            <!-- Preview Logo -->
            @if($partner->logo_url)

                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-3">
                        Preview Logo
                    </label>

                    <img src="{{ $partner->logo_url }}"
                         alt="{{ $partner->name }}"
                         class="w-28 h-28 object-contain rounded-xl border border-gray-200 bg-gray-50 p-2">

                </div>

            @endif



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

@endsection