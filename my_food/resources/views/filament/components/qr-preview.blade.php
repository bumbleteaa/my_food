<div class="flex flex-col items-center gap-2 p-4 bg-gray-50 rounded-lg">
    @if($record?->images)
        <img src="{{ Storage::disk('public')->url($record->images) }}" 
             alt="QR Code" 
             class="w-48 h-48 border-2 border-gray-200 rounded">
    @else
        <div class="w-48 h-48 flex items-center justify-center bg-gray-200 rounded">
            <span class="text-gray-500">Save to see QR code preview</span>
        </div>
    @endif
    
    @if($record?->qr_value)
        <a href="{{ $record->qr_value }}" 
           target="_blank" 
           class="text-sm text-blue-600 hover:underline">
            Test QR Link →
        </a>
    @endif
</div>