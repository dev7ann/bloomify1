<div class="wellness-tip p-4 bg-green-50 rounded-lg shadow-md max-w-md mx-auto my-4">
    @if($wellnessTip)
        <div class="flex items-center mb-2">
            <span class="text-green-600 text-2xl mr-2">🌿</span>
            <h3 class="text-green-800 font-semibold text-lg">{{ $wellnessTip->title }}</h3>
        </div>
        <p class="text-green-700 text-sm leading-relaxed">
            {{ $wellnessTip->content }}
        </p>
    @else
        <p class="text-gray-500 italic text-center">No wellness tips available yet.</p>
    @endif
</div>
