@props(['item', 'icon', 'color'])
@php
    $bgClass = match ($color) {
        'blue' => 'bg-blue-50',
        'yellow' => 'bg-yellow-50',
        'purple' => 'bg-purple-50',
        default => 'bg-gray-50',
    };
@endphp
<div class="flex items-start gap-3 p-3 rounded-lg border border-gray-100 bg-white hover:border-gray-300 transition">
    <div class="w-10 h-10 rounded-lg flex-shrink-0 flex items-center justify-center text-lg {{ $bgClass }}">
        {{ $icon }}
    </div>
    <div class="flex-1 min-w-0">
        <p class="font-bold text-gray-800 text-sm truncate">{{ $item->providerName }}</p>
        <p class="text-xs text-gray-500 truncate">{{ $item->description }}</p>

        <div class="flex justify-between items-center mt-2">
            <span class="text-[10px] bg-gray-100 text-gray-600 px-2 py-0.5 rounded">Qty: {{ $item->quantity }}</span>
            <p class="text-sm font-bold text-[#2CB38B]">Rp {{ number_format($item->estimatedCost, 0, ',', '.') }}</p>
        </div>

        @if ($item->bookingLink)
            <a href="{{ $item->bookingLink }}" target="_blank"
                class="text-[10px] text-blue-500 hover:underline mt-1 block">🔗 Link Booking</a>
        @endif

        @if ($item->order && $item->order->status == 'paid')
            <span
                class="text-[10px] text-green-600 font-bold bg-green-50 px-2 py-0.5 rounded mt-1 inline-block">LUNAS</span>
        @endif
    </div>
</div>
