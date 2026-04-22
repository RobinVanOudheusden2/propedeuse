@if ($paginator->hasPages())
    <nav aria-label="Paginanavigatie">
        <ul class="pagination-list">
            @if ($paginator->onFirstPage())
                <li><span class="btn is-disabled">&laquo; Vorige</span></li>
            @else
                <li><a class="btn" href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo; Vorige</a></li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li><span class="btn is-disabled">{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li><span class="btn btn-primary" aria-current="page">{{ $page }}</span></li>
                        @else
                            <li><a class="btn" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li><a class="btn" href="{{ $paginator->nextPageUrl() }}" rel="next">Volgende &raquo;</a></li>
            @else
                <li><span class="btn is-disabled">Volgende &raquo;</span></li>
            @endif
        </ul>
    </nav>
@endif
