@extends('layouts.admin')

@section('content')

<div class="p-8 bg-gradient-to-br from-slate-50 to-slate-100 min-h-screen">

    <!-- Header -->
    <div class="flex justify-between items-center mb-8">

        <div>
            <h2 class="text-3xl font-bold text-gray-800">
                Manajemen Partner
            </h2>

            <p class="text-gray-500 text-sm mt-1">
                Kelola semua data partner Anda di sini
            </p>
        </div>

        <!-- Button Tambah -->
        <a href="{{ route('admin.partners.create') }}"
           class="bg-gradient-to-r from-indigo-600 to-indigo-700 text-white px-6 py-2.5 rounded-lg font-semibold hover:shadow-lg hover:from-indigo-700 hover:to-indigo-800 transition-all duration-300 transform hover:scale-105">

            + Tambah Partner Baru

        </a>

    </div>



    <!-- Alert Success -->
    @if(session('success'))

        <div class="bg-gradient-to-r from-green-50 to-emerald-50 text-green-700 p-4 rounded-lg mb-6 border border-green-200 shadow-sm flex items-center gap-3">

            <svg class="w-5 h-5"
                 fill="currentColor"
                 viewBox="0 0 20 20">

                <path fill-rule="evenodd"
                      d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                      clip-rule="evenodd"/>

            </svg>

            <span class="font-medium">
                {{ session('success') }}
            </span>

        </div>

    @endif



    <!-- Table Container -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">

        <div class="overflow-x-auto">

            <table class="w-full">

                <!-- Table Head -->
                <thead>

                    <tr class="bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">

                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">
                            Nama Partner
                        </th>

                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">
                            Logo
                        </th>

                        <th class="px-6 py-4 text-center text-sm font-bold text-gray-700 uppercase tracking-wider">
                            Aksi
                        </th>

                    </tr>

                </thead>



                <!-- Table Body -->
                <tbody class="divide-y divide-gray-200">

                    @forelse($partners as $partner)

                        <tr class="hover:bg-gradient-to-r hover:from-indigo-50 hover:to-blue-50 transition-colors duration-200 group">

                            <!-- Nama -->
                            <td class="px-6 py-4">

                                <div class="font-semibold text-gray-800 group-hover:text-indigo-600 transition">

                                    {{ $partner->name }}

                                </div>

                                <p class="text-sm text-gray-500 mt-1">
                                    Partner resmi AmikomEventHub
                                </p>

                            </td>



                            <!-- Logo -->
                            <td class="px-6 py-4">

                                @if($partner->logo_url)

                                    <img src="{{ $partner->logo_url }}"
                                         alt="{{ $partner->name }}"
                                         class="w-14 h-14 object-contain rounded-xl border border-gray-200 bg-white p-1 shadow-sm">

                                @else

                                    <span class="text-gray-500 text-sm">
                                        -
                                    </span>

                                @endif

                            </td>



                            <!-- Tombol Aksi -->
                            <td class="px-6 py-4">

                                <div class="flex gap-2 justify-center">

                                    <!-- Edit -->
                                    <a href="{{ route('admin.partners.edit', $partner->id) }}"
                                       class="inline-flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-blue-700 hover:shadow-md transition-all duration-200 transform hover:scale-105">

                                        <svg class="w-4 h-4"
                                             fill="none"
                                             stroke="currentColor"
                                             viewBox="0 0 24 24">

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>

                                        </svg>

                                        Edit

                                    </a>



                                    <!-- Delete -->
                                    <form action="{{ route('admin.partners.destroy', $partner->id) }}"
                                          method="POST"
                                          class="inline"
                                          onsubmit="return confirm('Anda yakin ingin menghapus partner ini secara permanen?');">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="inline-flex items-center gap-2 bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-red-700 hover:shadow-md transition-all duration-200 transform hover:scale-105">

                                            <svg class="w-4 h-4"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 viewBox="0 0 24 24">

                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>

                                            </svg>

                                            Hapus

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="3" class="px-6 py-12 text-center">

                                <div class="flex flex-col items-center justify-center">

                                    <svg class="w-16 h-16 text-gray-300 mb-4"
                                         fill="none"
                                         stroke="currentColor"
                                         viewBox="0 0 24 24">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="1.5"
                                              d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>

                                    </svg>

                                    <p class="text-gray-500 font-medium text-lg">
                                        Belum ada data partner
                                    </p>

                                    <p class="text-gray-400 text-sm mt-1">
                                        Silakan tambah partner baru untuk memulai
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection