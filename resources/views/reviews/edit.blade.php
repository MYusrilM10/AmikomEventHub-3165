@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <!-- Page Header -->
        <div class="mb-8">
            <a href="{{ route('events.show', $review->event) }}" class="text-blue-500 hover:text-blue-600 mb-4 inline-block">← Kembali ke acara</a>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Edit Review</h1>
            <h2 class="text-xl text-gray-600">{{ $review->event->title }}</h2>
        </div>

        <!-- Event Info Card -->
        <div class="bg-white p-4 rounded-lg border border-gray-200 mb-6 flex gap-4">
            @if($review->event->poster_path)
                <img src="{{ asset('storage/' . $review->event->poster_path) }}" alt="{{ $review->event->title }}" class="w-24 h-24 object-cover rounded">
            @else
                <div class="w-24 h-24 bg-gray-200 rounded flex items-center justify-center">
                    <span class="text-gray-400">No Image</span>
                </div>
            @endif
            <div class="flex-1">
                <p class="text-gray-600"><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($review->event->date)->format('d M Y H:i') }}</p>
                <p class="text-gray-600"><strong>Lokasi:</strong> {{ $review->event->location }}</p>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white p-6 rounded-lg border border-gray-200">
            @include('components.review-form', [
                'actionUrl' => route('reviews.update', $review),
                'review' => $review,
                'event' => $review->event
            ])
        </div>

        <!-- Delete Section -->
        <div class="mt-6 p-4 bg-red-50 border border-red-200 rounded-lg">
            <p class="text-sm text-red-800 mb-3">Ingin menghapus review ini?</p>
            <form action="{{ route('reviews.destroy', $review) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition" onclick="return confirm('Apakah Anda yakin? Tindakan ini tidak dapat dibatalkan.')">
                    Hapus Review
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
