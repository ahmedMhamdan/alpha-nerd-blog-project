@extends('site.layout')

@section('title', 'Alpha Nerd | Search')

@push('styles')
<style>
  .search-hero{
    display:grid;
    grid-template-columns:1fr;
    gap:18px;
  }

  .search-top{
    display:flex;
    align-items:flex-start;
    justify-content:space-between;
    gap:18px;
    flex-wrap:wrap;
  }

  .search-desc{
    max-width:720px;
    margin:0;
    color:var(--muted);
    font-size:13px;
    line-height:1.8;
  }

  .search-box{
    margin-top:18px;
    padding:16px;
    border:1px solid rgba(163,230,53,.14);
    border-radius:20px;
    background:rgba(7,11,10,.42);
  }

  .searchbar{
    display:grid;
    grid-template-columns:1fr auto auto;
    gap:12px;
    align-items:center;
  }

  .search-input-wrap{
    position:relative;
  }

  .search-icon{
    position:absolute;
    left:14px;
    top:50%;
    transform:translateY(-50%);
    width:18px;
    height:18px;
    color:var(--muted);
    pointer-events:none;
  }

  .searchbar .input{
    padding-left:42px;
    min-height:46px;
  }

  .result-meta{
    margin-top:14px;
    color:var(--muted);
    font-size:12px;
    line-height:1.8;
  }

  .result-meta strong{
    color:var(--accent);
  }

  .search-card{
    display:flex;
    gap:18px;
    align-items:center;
  }

  .search-thumb{
    flex:0 0 250px;
    width:250px;
    display:block;
  }

  .search-thumb .thumb,
  .search-thumb > .thumb{
    width:100%;
    height:155px;
    border-radius:18px;
    object-fit:cover;
  }

  .search-content{
    flex:1;
    min-width:0;
  }

  .search-content .badge{
    margin-bottom:10px;
  }

  .search-title-row{
    display:flex;
    align-items:flex-start;
    justify-content:space-between;
    gap:12px;
    flex-wrap:wrap;
  }

  .read-more{
    color:var(--accent);
    font-size:12px;
    font-weight:900;
    white-space:nowrap;
  }

  .empty-state{
    text-align:center;
    padding:44px 18px;
    border:1px dashed rgba(163,230,53,.22);
    border-radius:22px;
    background:rgba(7,11,10,.35);
  }

  .empty-icon{
    width:56px;
    height:56px;
    margin:0 auto 14px;
    display:grid;
    place-items:center;
    border-radius:18px;
    border:1px solid rgba(163,230,53,.18);
    background:rgba(163,230,53,.07);
    color:var(--accent);
  }

  .empty-icon svg{
    width:26px;
    height:26px;
  }

  .empty-state h3{
    margin:0 0 8px;
    font-family:'Orbitron', sans-serif;
    font-size:20px;
  }

  .empty-state p{
    margin:0;
    color:var(--muted);
    font-size:13px;
    line-height:1.7;
  }

  @media (max-width:800px){
    .searchbar{
      grid-template-columns:1fr;
    }

    .search-card{
      flex-direction:column;
      align-items:stretch;
    }

    .search-thumb{
      width:100%;
      flex:0 0 auto;
    }

    .search-thumb .thumb,
    .search-thumb > .thumb{
      height:230px;
    }
  }
  .category-slider-wrap{
  position:relative;
  display:flex;
  align-items:center;
  gap:10px;
  margin-top:14px;
}

.category-slider{
  flex:1;
  display:flex;
  align-items:center;
  gap:10px;
  overflow-x:auto;
  scroll-behavior:smooth;
  padding:4px 2px 10px;
  scrollbar-width:thin;
  scrollbar-color:rgba(163,230,53,.35) transparent;
}

.category-slider::-webkit-scrollbar{
  height:7px;
}

.category-slider::-webkit-scrollbar-track{
  background:rgba(255,255,255,.04);
  border-radius:999px;
}

.category-slider::-webkit-scrollbar-thumb{
  background:rgba(163,230,53,.35);
  border-radius:999px;
}

.category-slider .chip-link{
  flex:0 0 auto;
  max-width:360px;
  white-space:nowrap;
  overflow:hidden;
  text-overflow:ellipsis;
}

.cat-slide-btn{
  width:38px;
  height:38px;
  flex:0 0 38px;
  display:grid;
  place-items:center;
  border-radius:999px;
  border:1px solid rgba(163,230,53,.18);
  background:rgba(7,11,10,.66);
  color:var(--text);
  cursor:pointer;
  font-size:20px;
  font-weight:900;
  transition:.18s ease;
}

.cat-slide-btn:hover{
  color:var(--accent);
  border-color:rgba(163,230,53,.45);
  box-shadow:0 0 0 4px rgba(163,230,53,.07);
}

html[data-theme="light"] .cat-slide-btn{
  background:#ffffff !important;
  border:1px solid #d9e2dc !important;
  color:#334155 !important;
  box-shadow:0 8px 20px rgba(15,23,42,.08) !important;
}

html[data-theme="light"] .cat-slide-btn:hover{
  background:#f0fdf4 !important;
  border-color:#16a34a !important;
  color:#16a34a !important;
}

html[data-theme="light"] .category-slider::-webkit-scrollbar-track{
  background:#eef2f0;
}

html[data-theme="light"] .category-slider::-webkit-scrollbar-thumb{
  background:#cbd5e1;
}

html[data-theme="light"] .category-slider::-webkit-scrollbar-thumb:hover{
  background:#16a34a;
}

@media (max-width:700px){
  .cat-slide-btn{
    display:none;
  }

  .category-slider .chip-link{
    max-width:260px;
  }
}
</style>
@endpush

@section('content')

<section class="section search-hero">
  <div class="search-top">
    <div>
      <h2 class="small-title">Search</h2>
      <p class="search-desc">
        Search inside Alpha Nerd posts and filter content by category. This page demonstrates
        dynamic Laravel queries, filters, pagination, and clean result rendering.
      </p>
    </div>

    <a class="btn-outline" href="{{ route('home') }}">Back Home</a>
  </div>

  <div class="search-box">
    <form class="searchbar" action="{{ route('search') }}" method="get">
      <div class="search-input-wrap">
        <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="11" cy="11" r="7"></circle>
          <path d="M21 21l-4.3-4.3"></path>
        </svg>

        <input
          class="input"
          name="q"
          placeholder="Search posts by title or content..."
          value="{{ $q ?? '' }}"
        />
      </div>

      @if(!empty($cat))
        <input type="hidden" name="cat" value="{{ $cat }}">
      @endif

      <button class="btn primary" type="submit">Search</button>
      <a class="btn-outline" href="{{ route('search') }}">Clear</a>
    </form>

<div class="category-slider-wrap" style="margin-top:14px;">
  <button class="cat-slide-btn left" type="button" onclick="scrollSearchCats(-1)" aria-label="Scroll categories left">
    ‹
  </button>

  <div class="category-slider" id="searchCategorySlider" aria-label="Search filters">
    <a class="chip-link {{ empty($cat) ? 'active' : '' }}"
       href="{{ route('search', ['q' => $q]) }}">
      All
    </a>

    @foreach($categories as $category)
      <a class="chip-link {{ ($cat ?? '') === $category->name ? 'active' : '' }}"
         href="{{ route('search', ['q' => $q, 'cat' => $category->name]) }}"
         title="{{ $category->name }}">
        {{ ucfirst($category->name) }}
      </a>
    @endforeach
  </div>

  <button class="cat-slide-btn right" type="button" onclick="scrollSearchCats(1)" aria-label="Scroll categories right">
    ›
  </button>
</div>

    <div class="result-meta">
      @if(($q ?? '') !== '')
        Showing <strong>{{ $posts->total() }}</strong> results for <strong>“{{ $q }}”</strong>
      @else
        Showing <strong>{{ $posts->total() }}</strong> results
      @endif

      @if(!empty($cat))
        <span> • filtered by <strong>{{ $cat }}</strong></span>
      @endif
    </div>
  </div>
</section>

<section class="section" style="margin-top:24px;">
  <div class="section-head">
    <div>
      <h2 class="small-title">Results</h2>
      <p class="muted" style="margin:0;">Browse matched posts with category, author, date, and preview.</p>
    </div>
  </div>

  <div class="post-list">
    @forelse($posts as $post)
      <article class="post-card search-card">
        <a class="search-thumb" href="{{ route('posts.show', $post) }}">
          @if($post->image)
            <img class="thumb" src="{{ asset($post->image) }}" alt="{{ $post->title }}">
          @else
            <div class="thumb"></div>
          @endif
        </a>

        <div class="search-content">
          <span class="badge">
            <span class="dot"></span>
            {{ $post->category?->name ?? 'General' }}
          </span>

          <div class="search-title-row">
            <a href="{{ route('posts.show', $post) }}">
              <h3 class="title">{{ $post->title }}</h3>
            </a>
          </div>

          <div class="meta">
            <span>{{ $post->created_at->toFormattedDateString() }}</span>
            <span>by Admin</span>
          </div>

          <p class="excerpt">{{ \Illuminate\Support\Str::limit($post->content, 155) }}</p>
        </div>
      </article>
    @empty
      <div class="empty-state">
        <div class="empty-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="11" cy="11" r="7"></circle>
            <path d="M21 21l-4.3-4.3"></path>
          </svg>
        </div>

        <h3>No results found</h3>
        <p>Try another keyword or clear the filters to browse all posts.</p>
      </div>
    @endforelse
  </div>

  <div style="margin-top:18px;">
    {{ $posts->appends(request()->query())->links('vendor.pagination.cyber') }}
  </div>
</section>
@push('scripts')
<script>
  function scrollSearchCats(direction) {
    const slider = document.getElementById('searchCategorySlider');

    if (!slider) return;

    slider.scrollBy({
      left: direction * 280,
      behavior: 'smooth'
    });
  }
</script>
@endpush
@endsection
