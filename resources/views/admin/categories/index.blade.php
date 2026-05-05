@extends('layouts.admin')
@section('content')
<div class="p-8 bg-gradient-to-br from-slate-50 to-slate-100 min-h-screen">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-bold text-gray-800">Manajemen Kategori</h2>
            <p class="text-gray-500 text-sm mt-1">Kelola semua kategori event Anda di sini</p>
        </div>
        <button class="bg-gradient-to-r from-indigo-600 to-indigo-700 text-white px-6 py-2.5 rounded-lg font-semibold hover:shadow-lg hover:from-indigo-700 hover:to-indigo-800 transition-all duration-300 transform hover:scale-105">+ Tambah Kategori</button>
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">No</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">Nama Kategori</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">Jumlah Event</th>
                        <th class="px-6 py-4 text-center text-sm font-bold text-gray-700 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr class="hover:bg-gradient-to-r hover:from-indigo-50 hover:to-blue-50 transition-colors duration-200 group">
                        <td class="px-6 py-4">
                            <span class="text-gray-700 font-semibold">1</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-semibold text-gray-800 group-hover:text-indigo-600 transition">Musik</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-gray-700 font-medium">12 event</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2 justify-center">
                                <button class="inline-flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-blue-700 hover:shadow-md transition-all duration-200 transform hover:scale-105">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></path></svg>
                                    Edit
                                </button>
                                <button class="inline-flex items-center gap-2 bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-red-700 hover:shadow-md transition-all duration-200 transform hover:scale-105">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></path></svg>
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-gradient-to-r hover:from-indigo-50 hover:to-blue-50 transition-colors duration-200 group">
                        <td class="px-6 py-4">
                            <span class="text-gray-700 font-semibold">2</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-semibold text-gray-800 group-hover:text-indigo-600 transition">Workshop</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-gray-700 font-medium">8 event</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2 justify-center">
                                <button class="inline-flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-blue-700 hover:shadow-md transition-all duration-200 transform hover:scale-105">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></path></svg>
                                    Edit
                                </button>
                                <button class="inline-flex items-center gap-2 bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-red-700 hover:shadow-md transition-all duration-200 transform hover:scale-105">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></path></svg>
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-gradient-to-r hover:from-indigo-50 hover:to-blue-50 transition-colors duration-200 group">
                        <td class="px-6 py-4">
                            <span class="text-gray-700 font-semibold">3</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-semibold text-gray-800 group-hover:text-indigo-600 transition">Olahraga</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-gray-700 font-medium">5 event</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2 justify-center">
                                <button class="inline-flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-blue-700 hover:shadow-md transition-all duration-200 transform hover:scale-105">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></path></svg>
                                    Edit
                                </button>
                                <button class="inline-flex items-center gap-2 bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-red-700 hover:shadow-md transition-all duration-200 transform hover:scale-105">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></path></svg>
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection