@if ($paginator->hasPages())
    <div class="ui teal pagination menu">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a class="icon item disabled"> <i class="left chevron icon"></i> </a>
        @else
            <a class="icon item" href="{{ $paginator->previousPageUrl() }}" rel="prev"> <i class="left chevron icon"></i> </a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a class="icon item" href="{{ $paginator->nextPageUrl() }}" rel="next"> <i class="right chevron icon"></i> </a>
        @else
            <a class="icon item disabled"> <i class="right chevron icon"></i> </a>
        @endif
    </div>
@endif
