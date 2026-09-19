<div class="px-3 py-1 rounded-full text-sm font-medium
            @if ($status === 'success') bg-green-100 text-green-800 @endif
            @if ($status === 'failed') bg-red-100 text-red-800 @endif
            @if ($status === 'pending') bg-yellow-100 text-yellow-800 @endif
        ">
            {{ $status }}
        </div>