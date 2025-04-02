<div class="mb-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
        <h1 class="text-2xl font-bold text-textHeading mb-2 md:mb-0">{{ $title }}</h1>
        
        @if(isset($items))
            <ol class="flex flex-wrap items-center text-sm">
                {{ $items }}
            </ol>
        @endif
    </div>
</div>