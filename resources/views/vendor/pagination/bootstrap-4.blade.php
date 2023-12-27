@if ($paginator->hasPages())



    <div class="product__pagination blog__pagination">
        @if ($paginator->onFirstPage())
            <a href="#"><i class="fa fa-long-arrow-left"></i></a>
        @else
             <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                    aria-label="@lang('pagination.previous')">
                <i class="fa fa-long-arrow-left"></i></a>
        @endif
        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <a href="">{{ $element }}</a>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a href="">{{ $page }}</a>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                <i class="fa fa-long-arrow-right"></i>
            </a>
        @else
            <a href="#"><i class="fa fa-long-arrow-right"></i></a>
        @endif

    </div>
@endif
