<!-- Review Stats Component with Premium UI/UX -->
<div class="review-stats bg-white p-8 rounded-3xl border border-slate-100 shadow-xl shadow-slate-100/50">
    @if($averageRating > 0 || $totalReviews > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Left Side: Main Stats -->
            <div class="flex flex-col justify-center items-center md:border-r md:border-slate-100 md:pr-8">
                <div class="text-center">
                    <div class="text-6xl font-black text-slate-800 tracking-tight">{{ number_format($averageRating, 1) }}
                    </div>
                    <div class="flex justify-center gap-1.5 mt-3">
                        @for ($i = 1; $i <= 5; $i++)
                            <i
                                class="fa-solid fa-star text-xl {{ $i <= round($averageRating) ? 'text-amber-400' : 'text-slate-200' }}"></i>
                        @endfor
                    </div>
                    <p class="text-slate-550 mt-4 text-sm font-semibold tracking-wide uppercase">{{ $totalReviews }} ulasan
                        terverifikasi</p>
                </div>
            </div>

            <!-- Right Side: Rating Distribution -->
            <div class="space-y-3 flex flex-col justify-center">
                @php
                    $reviews = $event->reviews()->where('is_verified_purchase', true)->get();
                    $distribution = [
                        5 => $reviews->where('rating', 5)->count(),
                        4 => $reviews->where('rating', 4)->count(),
                        3 => $reviews->where('rating', 3)->count(),
                        2 => $reviews->where('rating', 2)->count(),
                        1 => $reviews->where('rating', 1)->count(),
                    ];
                @endphp

                @foreach([5, 4, 3, 2, 1] as $star)
                    <div class="flex items-center gap-3">
                        <div class="w-10 flex items-center justify-end gap-1">
                            <span class="text-slate-600 font-bold text-sm">{{ $star }}</span>
                            <i class="fa-solid fa-star text-xs text-amber-400"></i>
                        </div>
                        <div class="flex-1 h-2 bg-slate-100 rounded-full overflow-hidden">
                            @php
                                $percentage = $totalReviews > 0 ? ($distribution[$star] / $totalReviews) * 100 : 0;
                            @endphp
                            <div class="h-full bg-gradient-to-r from-amber-450 to-amber-400 rounded-full transition-all duration-500"
                                style="width: {{ $percentage }}%"></div>
                        </div>
                        <div class="w-8 text-left text-sm text-slate-400 font-medium">{{ $distribution[$star] }}</div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Call to Action -->
        <div class="mt-8 pt-8 border-t border-slate-150/60">
            @auth
                @php
                    $userReview = \App\Models\Review::where('user_id', auth()->id())
                        ->where('event_id', $event->id)
                        ->first();
                @endphp

                @if($userReview)
                    <div
                        class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-indigo-50/40 border border-indigo-100/60 p-5 rounded-2xl">
                        <div class="flex items-start gap-3">
                            <i class="fa-solid fa-circle-check text-xl text-indigo-500 mt-0.5"></i>
                            <div>
                                <p class="text-sm font-bold text-indigo-950">Terima kasih atas kontribusi Anda!</p>
                                <p class="text-xs text-indigo-700/80 mt-0.5">Anda sudah memberikan rating <strong
                                        class="font-black">{{ $userReview->rating }}/5</strong> untuk acara ini.</p>
                            </div>
                        </div>
                        <a href="{{ route('reviews.edit', $userReview) }}"
                            class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 active:scale-95 transition-all text-sm font-bold shadow-md shadow-indigo-100">
                            <i class="fa-regular fa-pen-to-square"></i>
                            Edit Ulasan Anda
                        </a>
                    </div>
                @else
                    <div id="reviewStatusBox"
                        class="p-5 rounded-2xl bg-slate-50 border border-slate-100/80 mb-5 transition-all duration-300">
                        <p class="text-sm text-slate-500 flex items-center gap-3">
                            <span
                                class="inline-block w-4 h-4 border-2 border-indigo-600 border-t-transparent rounded-full animate-spin"></span>
                            Memeriksa kelayakan review...
                        </p>
                    </div>
                    <a href="{{ route('reviews.create', $event) }}" id="reviewButton"
                        class="inline-flex w-full sm:w-auto items-center justify-center gap-2 px-6 py-3.5 bg-indigo-600 text-white rounded-2xl hover:bg-indigo-700 hover:-translate-y-0.5 active:scale-98 transition-all text-sm font-bold shadow-lg shadow-indigo-100/70">
                        <i class="fa-solid fa-star"></i>
                        Beri Rating & Review
                    </a>
                @endif
            @else
                <div
                    class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-slate-50/70 border border-slate-100 p-5 rounded-2xl">
                    <p class="text-sm text-slate-500 font-medium">Silakan masuk ke akun Anda terlebih dahulu untuk memberikan
                        rating & ulasan.</p>
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition font-bold text-sm shadow-md shadow-indigo-100/50">
                        Masuk / Login
                    </a>
                </div>
            @endauth
        </div>
    @else
        <div class="text-center py-10 px-4 bg-slate-50/30 border border-slate-100 border-dashed rounded-3xl">
            <div class="w-14 h-14 mx-auto bg-amber-50/60 rounded-full flex items-center justify-center mb-4">
                <i class="fa-regular fa-star text-2xl text-amber-500"></i>
            </div>
            <p class="text-slate-800 text-lg font-extrabold mb-1">Belum Ada Ulasan</p>
            <p class="text-slate-400 text-sm mb-6 max-w-sm mx-auto">Jadilah orang pertama yang memberikan penilaian dan
                ulasan untuk acara ini!</p>

            @auth
                <div id="reviewStatusBox"
                    class="p-5 rounded-2xl bg-white border border-slate-100 mb-5 text-left max-w-md mx-auto transition-all duration-300">
                    <p class="text-sm text-slate-500 flex items-center gap-3">
                        <span
                            class="inline-block w-4 h-4 border-2 border-indigo-600 border-t-transparent rounded-full animate-spin"></span>
                        Memeriksa kelayakan review...
                    </p>
                </div>
                <a href="{{ route('reviews.create', $event) }}" id="reviewButton"
                    class="inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-indigo-600 text-white rounded-2xl hover:bg-indigo-700 hover:-translate-y-0.5 active:scale-98 transition-all text-sm font-bold shadow-lg shadow-indigo-100/70">
                    <i class="fa-solid fa-star"></i>
                    Beri Ulasan Sekarang
                </a>
            @else
                <a href="{{ route('login') }}"
                    class="inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-indigo-600 text-white rounded-2xl hover:bg-indigo-700 transition font-bold text-sm shadow-lg shadow-indigo-100/50">
                    Login untuk Memberi Rating
                </a>
            @endauth
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        @auth
            const statusBox = document.getElementById('reviewStatusBox');
            const reviewButton = document.getElementById('reviewButton');

            if (statusBox) {
                fetch("{{ route('review.status', $event) }}")
                    .then(response => response.json())
                    .then(data => {
                        console.log('Review Status:', data);

                        let html = '';
                        let boxClasses = 'p-5 rounded-2xl mb-5 transition-all duration-300';

                        if (data.can_review) {
                            // User can review - Green color scheme
                            html = `
                                <div class="flex items-center gap-3 text-emerald-800">
                                    <i class="fa-solid fa-circle-check text-xl text-emerald-500 flex-shrink-0"></i>
                                    <p class="text-sm font-bold">Anda berhak memberikan ulasan sekarang!</p>
                                </div>
                            `;
                            boxClasses += ' bg-emerald-50/50 border border-emerald-100';

                            if (reviewButton) {
                                reviewButton.disabled = false;
                                reviewButton.style.opacity = '1';
                                reviewButton.style.pointerEvents = 'auto';
                                reviewButton.classList.remove('opacity-50', 'pointer-events-none');
                            }
                        } else {
                            // User cannot review - custom status UI with FontAwesome icons
                            let iconHtml = '<i class="fa-solid fa-clock text-xl text-amber-500 mt-0.5 flex-shrink-0"></i>';

                            if (data.status === 'not_purchased') {
                                iconHtml = '<i class="fa-solid fa-circle-xmark text-xl text-rose-500 mt-0.5 flex-shrink-0"></i>';
                                boxClasses += ' bg-rose-50/50 border border-rose-100';
                            } else if (data.status === 'already_reviewed') {
                                iconHtml = '<i class="fa-solid fa-circle-check text-xl text-indigo-500 mt-0.5 flex-shrink-0"></i>';
                                boxClasses += ' bg-indigo-50/50 border border-indigo-100';
                            } else if (data.status === 'event_just_finished') {
                                iconHtml = '<i class="fa-solid fa-hourglass-half text-xl text-amber-550 mt-0.5 flex-shrink-0 animate-pulse"></i>';
                                boxClasses += ' bg-amber-50/50 border border-amber-100';
                            } else if (data.status === 'event_not_finished') {
                                iconHtml = '<i class="fa-regular fa-calendar-days text-xl text-amber-550 mt-0.5 flex-shrink-0"></i>';
                                boxClasses += ' bg-amber-50/50 border border-amber-100';
                            } else {
                                boxClasses += ' bg-slate-50 border border-slate-100';
                            }

                            let additionalInfo = '';
                            if (data.time_remaining) {
                                additionalInfo = `<p class="text-xs text-slate-500 mt-1 flex items-center gap-1.5"><i class="fa-solid fa-hourglass-start text-xs text-amber-600 animate-spin"></i> Bisa menulis ulasan dalam: <strong>${data.time_remaining}</strong></p>`;
                            } else if (data.time_until) {
                                additionalInfo = `<p class="text-xs text-slate-550 mt-1.5 flex items-center gap-1.5"><i class="fa-solid fa-clock text-xs text-amber-550"></i> Pintu ulasan dibuka dalam: <strong>${data.time_until}</strong></p>`;
                            }

                            html = `
                                <div class="flex items-start gap-3">
                                    ${iconHtml}
                                    <div class="flex-1">
                                        <p class="text-sm font-bold text-slate-700 leading-tight">${data.message}</p>
                                        ${additionalInfo}
                                    </div>
                                </div>
                            `;

                            // Disable review button
                            if (reviewButton) {
                                reviewButton.disabled = true;
                                reviewButton.style.opacity = '0.4';
                                reviewButton.style.pointerEvents = 'none';
                                reviewButton.classList.add('opacity-40', 'pointer-events-none');
                                reviewButton.title = data.message;
                            }
                        }

                        statusBox.innerHTML = html;
                        statusBox.className = boxClasses;
                    })
                    .catch(error => {
                        console.error('Error fetching review status:', error);
                        statusBox.innerHTML = `
                            <div class="flex items-center gap-2.5 text-rose-800">
                                <i class="fa-solid fa-circle-exclamation text-lg text-rose-500"></i>
                                <p class="text-sm font-semibold">Gagal memuat status review. Silakan refresh halaman.</p>
                            </div>
                        `;
                        statusBox.className = 'p-5 rounded-2xl bg-rose-50 border border-rose-100 mb-5';
                    });
            }
        @endauth
});
</script>