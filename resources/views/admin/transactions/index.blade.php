@extends('layouts.admin')

@section('title', 'Laporan Transaksi - Admin')
@section('page_title', 'Laporan Transaksi')
@section('page_subtitle', 'Pantau arus kas dan penjualan tiket Anda.')

@section('content')

<div class="p-8 bg-gradient-to-br from-slate-50 to-slate-100 min-h-screen">

    <div class="flex flex-wrap justify-between items-center mb-10 gap-4">
    <div>
        <h1 class="text-3xl font-black">Laporan Transaksi</h1>
        <p class="text-slate-500 font-medium">Pantau arus kas dan penjualan tiket Anda.</p>
    </div>

    <div class="flex flex-wrap gap-4">
        <button class="px-6 py-3 border-2 border-slate-200 rounded-2xl font-bold hover:bg-white hover:border-indigo-600 hover:text-indigo-600 transition">
            Ekspor Excel
        </button>
        <button class="px-6 py-3 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg hover:bg-indigo-700 transition">
            Unduh PDF
        </button>
    </div>
</div>

<div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">

    <div class="px-8 py-6 bg-slate-50/50 border-b flex flex-wrap gap-4 items-center">
        <div class="flex-1 min-w-[300px]">
            <input type="text" placeholder="Cari Order ID, Nama, atau Email..."
                class="w-full px-5 py-3 rounded-xl border-slate-200 border bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition uppercase text-sm font-medium tracking-wide">
        </div>
        <div class="flex gap-2 flex-wrap">
            <select class="px-5 py-3 rounded-xl border-slate-200 border bg-white outline-none text-sm font-bold">
                <option>Semua Status</option>
                <option class="text-green-600">Success</option>
                <option class="text-orange-600">Pending</option>
                <option class="text-rose-600">Expired</option>
            </select>
            <select class="px-5 py-3 rounded-xl border-slate-200 border bg-white outline-none text-sm font-bold">
                <option>Tahun 2024</option>
                <option>Bulan Ini</option>
                <option>Bulan Lalu</option>
            </select>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50 text-slate-400 uppercase text-[10px] font-black tracking-widest">
                <tr>
                    <th class="px-8 py-4">Order ID</th>
                    <th class="px-8 py-4">Detail Pembeli</th>
                    <th class="px-8 py-4">Event</th>
                    <th class="px-8 py-4">Tgl Transaksi</th>
                    <th class="px-8 py-4">Status</th>
                    <th class="px-8 py-4 text-right">Total Tagihan</th>
                </tr>
            </thead>

            <tbody class="divide-y border-t">
                @forelse($transactions as $trx)
                    <tr class="hover:bg-slate-50/50 transition {{ $trx->status == 'pending' ? 'text-slate-400' : '' }}">
                        <td class="px-8 py-6">
                            <span class="font-mono font-bold px-3 py-1 rounded-lg text-sm {{ $trx->status == 'pending' ? 'bg-slate-100' : 'text-indigo-600 bg-indigo-50' }}">
                                {{ $trx->order_id }}
                            </span>
                        </td>
                        <td class="px-8 py-6">
                            <p class="font-bold text-slate-800">{{ $trx->customer_name }}</p>
                            <p class="text-xs text-slate-500">
                                {{ $trx->customer_email }}
                                <br>
                                {{ $trx->customer_phone }}
                            </p>
                        </td>
                        <td class="px-8 py-6">
                            <p class="font-medium text-slate-700">{{ $trx->event->title ?? '-' }}</p>
                        </td>
                        <td class="px-8 py-6 text-sm text-slate-500">
                            {{ $trx->created_at->format('d M Y, H:i') }}
                        </td>
                        <td class="px-8 py-6">
                            @if($trx->status === 'settlement' || $trx->status === 'success')
                                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-lg text-xs font-bold uppercase ring-1 ring-green-200">Success</span>
                            @elseif($trx->status === 'pending')
                                <span class="px-3 py-1 bg-orange-100 text-orange-700 rounded-lg text-xs font-bold uppercase ring-1 ring-orange-200">Pending</span>
                            @else
                                <span class="px-3 py-1 bg-rose-100 text-rose-700 rounded-lg text-xs font-bold uppercase ring-1 ring-rose-200">{{ $trx->status }}</span>
                            @endif
                        </td>
                        <td class="px-8 py-6 text-right font-black {{ $trx->status == 'pending' ? '' : 'text-slate-900' }}">
                            Rp {{ number_format($trx->total_price, 0, ',', '.') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-8 py-10 text-center text-slate-500">Belum ada transaksi</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="px-8 py-6 bg-slate-50/50 border-t flex flex-wrap justify-between items-center gap-4">
        <p class="text-sm text-slate-500 font-medium">Menampilkan {{ $transactions->count() }} dari {{ $transactions->total() }} transaksi</p>
        <div class="flex gap-2">
            <a href="{{ $transactions->previousPageUrl() ?: '#' }}"
                class="px-4 py-2 border rounded-xl text-sm font-bold {{ $transactions->onFirstPage() ? 'opacity-50 cursor-not-allowed bg-white' : 'hover:bg-white transition' }}">
                Previous
            </a>
            @for ($page = 1; $page <= min(2, $transactions->lastPage()); $page++)
                <a href="{{ $transactions->url($page) }}"
                    class="px-4 py-2 rounded-xl text-sm font-bold {{ $transactions->currentPage() === $page ? 'bg-indigo-600 text-white shadow-md' : 'border bg-white hover:bg-slate-50 transition' }}">
                    {{ $page }}
                </a>
            @endfor
            <a href="{{ $transactions->nextPageUrl() ?: '#' }}"
                class="px-4 py-2 border rounded-xl text-sm font-bold {{ $transactions->hasMorePages() ? 'hover:bg-white transition' : 'opacity-50 cursor-not-allowed bg-white' }}">
                Next
            </a>
        </div>
    </div>

</div>

</div>

@endsection