@if ($paginator->hasPages())
    <nav class="flex space-x-2">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <button class="btn-secondary py-1 px-3 opacity-50 cursor-not-allowed">
                <i class="fas fa-chevron-left"></i>
            </button>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="btn-secondary py-1 px-3">
                <i class="fas fa-chevron-left"></i>
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="btn-secondary py-1 px-3 opacity-50 cursor-default">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="bg-highlight text-white py-1 px-3 rounded-lg">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="btn-secondary py-1 px-3">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="btn-secondary py-1 px-3">
                <i class="fas fa-chevron-right"></i>
            </a>
        @else
            <button class="btn-secondary py-1 px-3 opacity-50 cursor-not-allowed">
                <i class="fas fa-chevron-right"></i>
            </button>
        @endif
    </nav>
@endif