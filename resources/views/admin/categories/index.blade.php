@extends('layouts.admin')

@section('content')

<div class="flex justify-between items-center mb-10">
    <div>
        <h1 class="text-3xl font-black">Manajemen Kategori</h1>
        <p class="text-slate-500">Kelola kategori event di sini</p>
    </div>

    <button class="px-6 py-3 bg-indigo-600 text-white rounded-xl font-bold hover:bg-indigo-700 flex items-center gap-2">
        <i class="fa-solid fa-plus w-5 h-5"></i>
        Tambah Kategori
    </button>
</div>

<div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-lg overflow-hidden">

    <table class="w-full text-left border-collapse">
        <thead class="bg-gradient-to-r from-indigo-600 to-indigo-700 text-white uppercase text-[10px] font-black tracking-widest">
            <tr>
                <th class="px-8 py-4 w-16">No</th>
                <th class="px-8 py-4">Nama Kategori</th>
                <th class="px-8 py-4">Aksi</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-slate-200">

            <tr class="hover:bg-indigo-50/50 transition">
                <td class="px-8 py-6 text-slate-500 font-semibold">1</td>
                <td class="px-8 py-6 font-semibold text-slate-800">Seminar</td>
                <td class="px-8 py-6 flex gap-2">
                    <button class="p-2.5 bg-indigo-50 text-indigo-600 rounded-xl hover:bg-indigo-600 hover:text-white transition"><i class="fa-solid fa-pen-to-square w-4 h-4"></i></button>
                    <button class="p-2.5 bg-rose-50 text-rose-600 rounded-xl hover:bg-rose-600 hover:text-white transition"><i class="fa-solid fa-trash w-4 h-4"></i></button>
                </td>
            </tr>

            <tr class="hover:bg-indigo-50/50 transition">
                <td class="px-8 py-6 text-slate-500 font-semibold">2</td>
                <td class="px-8 py-6 font-semibold text-slate-800">Konser</td>
                <td class="px-8 py-6 flex gap-2">
                    <button class="p-2.5 bg-indigo-50 text-indigo-600 rounded-xl hover:bg-indigo-600 hover:text-white transition"><i class="fa-solid fa-pen-to-square w-4 h-4"></i></button>
                    <button class="p-2.5 bg-rose-50 text-rose-600 rounded-xl hover:bg-rose-600 hover:text-white transition"><i class="fa-solid fa-trash w-4 h-4"></i></button>
                </td>
            </tr>

            <tr class="hover:bg-indigo-50/50 transition">
                <td class="px-8 py-6 text-slate-500 font-semibold">3</td>
                <td class="px-8 py-6 font-semibold text-slate-800">Workshop</td>
                <td class="px-8 py-6 flex gap-2">
                    <button class="p-2.5 bg-indigo-50 text-indigo-600 rounded-xl hover:bg-indigo-600 hover:text-white transition"><i class="fa-solid fa-pen-to-square w-4 h-4"></i></button>
                    <button class="p-2.5 bg-rose-50 text-rose-600 rounded-xl hover:bg-rose-600 hover:text-white transition"><i class="fa-solid fa-trash w-4 h-4"></i></button>
                </td>
            </tr>

        </tbody>
    </table>

</div>

@endsection