@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Review Saya</h1>

    @if($reviews->count() > 0)
        <div class="space-y-6">
            @foreach($reviews as $review)
                <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm">
                    <!-- Review Header -->
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">{{ $review->event->title }}</h3>
                            <p class="text-sm text-gray-500">{{ $review->created_at->format('d M Y') }}</p>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('reviews.edit', $review) }}" class="px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600 transition">
                                Edit
                            </a>
                            <form action="{{ route('reviews.destroy', $review) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1 bg-red-500 text-white text-sm rounded hover:bg-red-600 transition" onclick="return confirm('Yakin ingin menghapus?')">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Rating -->
                    <div class="flex items-center gap-2 mb-3">
                        <div class="flex gap-1">
                            @for ($i = 1; $i <= 5; $i++)
                                <span class="text-lg {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
                            @endfor
                        </div>
                        <span class="font-semibold text-gray-700">{{ $review->rating }}/5</span>
                    </div>

                    <!-- Title & Text -->
                    @if($review->title)
                        <h4 class="font-semibold text-gray-800 mb-2">{{ $review->title }}</h4>
                    @endif
                    @if($review->review_text)
                        <p class="text-gray-700 mb-3">{{ $review->review_text }}</p>
                    @endif

                    <!-- Event Link -->
                    <a href="{{ route('events.show', $review->event) }}" class="text-blue-500 hover:text-blue-600 text-sm">
                        Lihat Acara →
                    </a>
                </div>
            @endforeach

            <!-- Pagination -->
            @if($reviews->hasPages())
                <div class="mt-6">
                    {{ $reviews->links() }}
                </div>
            @endif
        </div>
    @else
        <div class="bg-gray-50 p-12 rounded-lg text-center">
            <p class="text-gray-500 text-lg mb-4">Anda belum memberikan review apapun</p>
            <a href="{{ route('home') }}" class="text-blue-500 hover:text-blue-600">Lihat acara tersedia →</a>
        </div>
    @endif
</div>
@endsection
