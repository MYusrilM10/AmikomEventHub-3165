@props(['popularity' => 'New'])

@if($popularity === 'Trending')
    <span class="inline-flex items-center gap-2 bg-gradient-to-r from-red-100 to-orange-100 text-red-700 px-4 py-2 rounded-full text-sm font-bold border border-red-300 shadow-sm">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path d="M7.5 2.75a.75.75 0 00-1.5 0v14.5a.75.75 0 001.5 0V2.75zM5.75 7a.75.75 0 00-1.5 0v10.5a.75.75 0 001.5 0V7zm3.5 4a.75.75 0 00-1.5 0v6.5a.75.75 0 001.5 0v-6.5zm7-6a.75.75 0 00-1.5 0v16.5a.75.75 0 001.5 0V5zm-3.5 3a.75.75 0 00-1.5 0v13.5a.75.75 0 001.5 0V8z"/>
        </svg>
        Trending
    </span>
@elseif($popularity === 'Popular')
    <span class="inline-flex items-center gap-2 bg-gradient-to-r from-yellow-100 to-amber-100 text-yellow-700 px-4 py-2 rounded-full text-sm font-bold border border-yellow-300 shadow-sm">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
        </svg>
        Popular
    </span>
@elseif($popularity === 'New')
    <span class="inline-flex items-center gap-2 bg-gradient-to-r from-purple-100 to-indigo-100 text-purple-700 px-4 py-2 rounded-full text-sm font-bold border border-purple-300 shadow-sm">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
        </svg>
        New
    </span>
@else
    <span class="inline-flex items-center gap-2 bg-gray-100 text-gray-700 px-4 py-2 rounded-full text-sm font-semibold">
        {{ $popularity }}
    </span>
@endif
