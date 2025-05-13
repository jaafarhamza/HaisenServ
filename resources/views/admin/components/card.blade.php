<div class="card {{ $class ?? '' }}">
    @if(isset($header))
        <div class="p-6 border-b border-secondary flex justify-between items-center">
            <h3 class="text-xl font-bold text-textHeading">{{ $header }}</h3>
            
            @if(isset($headerActions))
                <div class="flex space-x-2">
                    {{ $headerActions }}
                </div>
            @endif
        </div>
    @endif
    
    <div class="{{ isset($noPadding) && $noPadding ? '' : 'p-6' }}">
        {{ $slot }}
    </div>
    
    @if(isset($footer))
        <div class="p-4 border-t border-secondary">
            {{ $footer }}
        </div>
    @endif
</div>