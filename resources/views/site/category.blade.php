@extends('site.layout')

@section('title', 'Alpha Nerd | Categories')

@push('styles')
<style>
  .categories-hero{
    display:grid;
    grid-template-columns:1.1fr .9fr;
    gap:24px;
    align-items:stretch;
  }

  .categories-title{
    margin:0;
    font-family:'Orbitron', sans-serif;
    font-size:clamp(34px, 4vw, 58px);
    line-height:1.05;
    letter-spacing:-1px;
    text-transform:uppercase;
  }

  .categories-title span{
    color:var(--accent);
    text-shadow:0 0 34px rgba(163,230,53,.22);
  }

  .categories-text{
    max-width:760px;
    margin:18px 0 0;
    color:var(--soft);
    font-size:14px;
    line-height:1.9;
  }

  .category-panel{
    border:1px solid rgba(163,230,53,.18);
    border-radius:22px;
    background:rgba(7,11,10,.52);
    padding:18px;
    display:flex;
    flex-direction:column;
    justify-content:space-between;
    gap:18px;
  }

  .category-panel-title{
    margin:0 0 10px;
    font-family:'Orbitron', sans-serif;
    font-size:16px;
    text-transform:uppercase;
  }

  .category-panel p{
    margin:0;
    color:var(--muted);
    font-size:12px;
    line-height:1.8;
  }

  .category-stats{
    display:grid;
    grid-template-columns:repeat(2, 1fr);
    gap:12px;
  }

  .category-stat{
    border:1px solid rgba(163,230,53,.14);
    border-radius:18px;
    background:rgba(7,11,10,.42);
    padding:15px;
  }

  .category-stat h3{
    margin:0;
    font-family:'Orbitron', sans-serif;
    color:var(--accent);
    font-size:26px;
  }

  .category-stat p{
    margin:6px 0 0;
    color:var(--muted);
    font-size:12px;
    font-weight:800;
  }

  .category-toolbar{
    margin-top:24px;
  }

  .category-results-head{
    display:flex;
    align-items:flex-start;
    justify-content:space-between;
    gap:14px;
    flex-wrap:wrap;
    margin-bottom:20px;
  }

  .category-results-head p{
    margin:0;
    color:var(--muted);
    font-size:13px;
    line-height:1.8;
  }

  .category-card{
    display:flex;
    gap:18px;
    align-items:center;
  }

  .category-thumb{
    flex:0 0 245px;
    width:245px;
    display:block;
  }

  .category-thumb .thumb,
  .category-thumb > .thumb{
    width:100%;
    height:150px;
    border-radius:18px;
    object-fit:cover;
  }

  .category-content{
    flex:1;
    min-width:0;
  }

  .category-content .badge{
    margin-bottom:10px;
  }

  .empty-category{
    text-align:center;
    padding:44px 18px;
    border:1px dashed rgba(163,230,53,.22);
    border-radius:22px;
    background:rgba(7,11,10,.35);
  }

  .empty-category-icon{
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

  .empty-category-icon svg{
    width:26px;
    height:26px;
  }

  .empty-category h3{
    margin:0 0 8px;
    font-family:'Orbitron', sans-serif;
    font-size:20px;
  }

  .empty-category p{
    margin:0;
    color:var(--muted);
    font-size:13px;
    line-height:1.7;
  }

  @media (max-width:980px){
    .categories-hero{
      grid-template-columns:1fr;
    }
  }

  @media (max-width:760px){
    .category-card{
      flex-direction:column;
      align-items:stretch;
    }

    .category-thumb{
      width:100%;
      flex:0 0 auto;
    }

    .category-thumb .thumb,
    .category-thumb > .thumb{
      height:220px;
    }
  }

  @media (max-width:620px){
    .category-stats{
      grid-template-columns:1fr;
    }

    .categories-title{
      font-size:34px;
    }
  }
</style>
@endpush

@section('content')

<section class="section categories-hero">
  <div>
    <div class="badge">
      <span class="dot"></span>
      Category Filter
    </div>

    <h1 class="categories-title" style="margin-top:16px;">
      Browse <span>Topics</span>
    </h1>

    <p class="categories-text">
      Explore Alpha Nerd posts by category. This page shows dynamic filtering,
      Eloquent relationships, pagination, and clean category-based content display.
    </p>
  </div>

  <aside class="category-panel">
    <div>
      <h3 class="category-panel-title">Current View</h3>

      @if(request('cat'))
        <p>You are browsing posts inside the <strong style="color:var(--accent);">{{ request('cat') }}</strong> category.</p>
      @else
        <p>You are browsing all available posts from all categories.</p>
      @endif
    </div>

    <div class="category-stats">
      <div class="category-stat">
        <h3>{{ $categories->count() }}</h3>
        <p>Categories</p>
      </div>

      <div class="category-stat">
        <h3>{{ $posts->total() }}</h3>
        <p>Posts Found</p>
      </div>
    </div>
  </aside>
</section>

<section class="section category-toolbar">
  <div class="section-head">
    <div>
      <h2 class="small-title">Categories</h2>
      <p class="muted" style="margin:0;">Choose a topic to filter posts.</p>
    </div>

    <a class="btn-outline" href="{{ route('search') }}">Search Posts</a>
  </div>

<div class="category-slider-wrap">
  <button class="cat-slide-btn" type="button" onclick="scrollCategoryCats(-1)" aria-label="Scroll categories left">
    ‹
  </button>

  <div class="category-slider" id="categoryPageSlider" aria-label="Categories">
    <a class="chip-link {{ !request('cat') ? 'active' : '' }}"
       href="{{ route('categories') }}">
      All
    </a>

    @foreach($categories as $category)
      <a
        class="chip-link {{ request('cat') === $category->name ? 'active' : '' }}"
        href="{{ route('categories', ['cat' => $category->name]) }}"
        title="{{ $category->name }}"
      >
        {{ ucfirst($category->name) }}
      </a>
    @endforeach
  </div>

  <button class="cat-slide-btn" type="button" onclick="scrollCategoryCats(1)" aria-label="Scroll categories right">
    ›
  </button>
</div>
</section>

<section class="section" style="margin-top:24px;">
  <div class="category-results-head">
    <div>
      <h2 class="small-title">
        @if(request('cat'))
          {{ ucfirst(request('cat')) }} Posts
        @else
          All Posts
        @endif
      </h2>

      <p>
        Showing {{ $posts->total() }} post{{ $posts->total() === 1 ? '' : 's' }}
        @if(request('cat'))
          inside {{ request('cat') }}.
        @else
          across all categories.
        @endif
      </p>
    </div>
  </div>

  <div class="post-list">
    @forelse($posts as $post)
      <article class="post-card category-card">
        <a class="category-thumb" href="{{ route('posts.show', $post) }}">
          @if($post->image)
            <img class="thumb" src="{{ asset($post->image) }}" alt="{{ $post->title }}">
          @else
            <div class="thumb"></div>
          @endif
        </a>

        <div class="category-content">
          <span class="badge">
            <span class="dot"></span>
            {{ $post->category?->name ?? 'General' }}
          </span>

          <a href="{{ route('posts.show', $post) }}">
            <h3 class="title">{{ $post->title }}</h3>
          </a>

          <div class="meta">
            <span>{{ $post->created_at->toFormattedDateString() }}</span>
            <span>by Admin</span>
          </div>

          <p class="excerpt">{{ \Illuminate\Support\Str::limit($post->content, 150) }}</p>
        </div>
      </article>
    @empty
      <div class="empty-category">
        <div class="empty-category-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M4 4h7v7H4z"></path>
            <path d="M13 4h7v7h-7z"></path>
            <path d="M4 13h7v7H4z"></path>
            <path d="M13 13h7v7h-7z"></path>
          </svg>
        </div>

        <h3>No posts found</h3>
        <p>No posts are available in this category yet.</p>
      </div>
    @endforelse
  </div>

  <div style="margin-top:18px;">
    {{ $posts->appends(request()->query())->links('vendor.pagination.cyber') }}
  </div>
</section>
@push('scripts')
<script>
  function scrollCategoryCats(direction) {
    const slider = document.getElementById('categoryPageSlider');

    if (!slider) return;

    slider.scrollBy({
      left: direction * 320,
      behavior: 'smooth'
    });
  }
</script>
@endpush
@endsection
