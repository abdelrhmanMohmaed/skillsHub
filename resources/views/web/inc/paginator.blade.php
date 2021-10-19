@if ($paginator->hasPages())
    <!-- pagination -->
    <div class="col-md-12">
        <div class="post-pagination">
            @if ($paginator->onFirstPage())
                <a href="#" class="btn disabled pagination-back pull-left">@lang('web.back')</a>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="pagination-back pull-left">@lang('web.back')</a>
            @endif
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="pagination-next pull-right">@lang('web.next')</a>
            @else
                <a href="#" class="btn disabled pagination-next pull-right">@lang('web.next')</a>

            @endif
            <ul class="pages">
                @foreach ($elements as $element)
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="{{ $url }}">{{ $page }}</li>
                            @else
                                <li><a href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
    <!-- pagination -->
@endif
