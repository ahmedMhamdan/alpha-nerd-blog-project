@if ($paginator->hasPages())
  <div class="cyber-pagination">

    <div class="cyber-pagination-info">
      Showing
      <strong>{{ $paginator->firstItem() }}</strong>
      to
      <strong>{{ $paginator->lastItem() }}</strong>
      of
      <strong>{{ $paginator->total() }}</strong>
      results
    </div>

    <div class="cyber-pagination-links">

      @if ($paginator->onFirstPage())
        <span class="cyber-page-disabled">‹</span>
      @else
        <a class="cyber-page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">‹</a>
      @endif

      @foreach ($elements as $element)
        @if (is_string($element))
          <span class="cyber-page-disabled">{{ $element }}</span>
        @endif

        @if (is_array($element))
          @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
              <span class="cyber-page-active">{{ $page }}</span>
            @else
              <a class="cyber-page-link" href="{{ $url }}">{{ $page }}</a>
            @endif
          @endforeach
        @endif
      @endforeach

      @if ($paginator->hasMorePages())
        <a class="cyber-page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">›</a>
      @else
        <span class="cyber-page-disabled">›</span>
      @endif

    </div>
  </div>
@endif
