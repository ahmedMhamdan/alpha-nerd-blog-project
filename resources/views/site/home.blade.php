@extends('site.layout')

@section('title', 'Alpha Nerd | Cyber Blog')

@push('styles')
<style>
  .hero{
    display:grid;
    grid-template-columns:1.15fr .85fr;
    gap:24px;
    align-items:stretch;
  }

  .hero-main{
    min-height:360px;
    display:flex;
    flex-direction:column;
    justify-content:center;
  }

  .hero-kicker{
    display:inline-flex;
    align-items:center;
    gap:9px;
    width:max-content;
    padding:8px 12px;
    border:1px solid rgba(163,230,53,.22);
    border-radius:999px;
    background:rgba(163,230,53,.08);
    color:#D9F99D;
    font-size:12px;
    font-weight:900;
    margin-bottom:18px;
  }

  .hero-title{
    margin:0;
    font-family:'Orbitron', sans-serif;
    font-size:clamp(38px, 5vw, 72px);
    line-height:.98;
    letter-spacing:-1.5px;
    text-transform:uppercase;
  }

  .hero-title span{
    color:var(--accent);
    text-shadow:0 0 34px rgba(163,230,53,.22);
  }

  .hero-desc{
    max-width:720px;
    margin:18px 0 0;
    color:var(--soft);
    font-size:14px;
    line-height:1.9;
  }

  .hero-actions{
    display:flex;
    align-items:center;
    gap:12px;
    flex-wrap:wrap;
    margin-top:24px;
  }

  .hero-panel{
    position:relative;
    min-height:360px;
    display:flex;
    flex-direction:column;
    justify-content:space-between;
    gap:18px;
  }

  .terminal-card{
    border:1px solid rgba(163,230,53,.18);
    border-radius:20px;
    background:rgba(7,11,10,.58);
    overflow:hidden;
    box-shadow:0 0 40px rgba(163,230,53,.08);
  }

  .terminal-top{
    display:flex;
    align-items:center;
    gap:7px;
    padding:12px 14px;
    border-bottom:1px solid rgba(163,230,53,.12);
    background:rgba(255,255,255,.03);
  }

  .terminal-dot{
    width:10px;
    height:10px;
    border-radius:999px;
    background:var(--accent);
    box-shadow:0 0 14px rgba(163,230,53,.65);
  }

  .terminal-body{
    padding:16px;
    color:var(--soft);
    font-size:12px;
    line-height:1.9;
  }

  .terminal-body strong{
    color:var(--accent);
  }

  .stats-grid{
    display:grid;
    grid-template-columns:repeat(2, 1fr);
    gap:12px;
  }

  .stat-card{
    border:1px solid rgba(163,230,53,.14);
    border-radius:18px;
    background:rgba(7,11,10,.45);
    padding:16px;
  }

  .stat-card h3{
    margin:0;
    font-family:'Orbitron', sans-serif;
    color:var(--accent);
    font-size:28px;
  }

  .stat-card p{
    margin:6px 0 0;
    color:var(--muted);
    font-size:12px;
    font-weight:800;
  }

  .section-intro{
    margin:0;
    color:var(--muted);
    font-size:13px;
    line-height:1.8;
  }

  @media (max-width:980px){
    .hero{
      grid-template-columns:1fr;
    }

    .hero-main,
    .hero-panel{
      min-height:auto;
    }
  }

  @media (max-width:620px){
    .stats-grid{
      grid-template-columns:1fr;
    }

    .hero-title{
      font-size:38px;
    }
  }
</style>
@endpush

@section('content')

<section class="section hero">
  <div class="hero-main">
    <div class="hero-kicker">
      <span class="dot"></span>
      Cybersecurity Blog & CMS
    </div>

    <h1 class="hero-title">
      Alpha <span>Nerd</span>
    </h1>

    <p class="hero-desc">
      A modern Laravel blog and admin dashboard built for managing cybersecurity posts,
      categories, comments, contact messages, image uploads, search, pagination, and soft delete workflows.
    </p>

    <div class="hero-actions">
      <a class="btn primary" href="{{ route('search') }}">Explore Posts</a>
      <a class="btn-outline" href="{{ route('categories') }}">Browse Categories</a>
      <a class="btn-outline" href="{{ route('contact') }}">Contact</a>
    </div>
  </div>

  <div class="hero-panel">
    <div class="terminal-card">
      <div class="terminal-top">
        <span class="terminal-dot"></span>
        <span class="terminal-dot"></span>
        <span class="terminal-dot"></span>
      </div>

      <div class="terminal-body">
        <div><strong>$</strong> php artisan serve</div>
        <div><strong>&gt;</strong> Laravel CMS running...</div>
        <div><strong>&gt;</strong> Posts CRUD enabled</div>
        <div><strong>&gt;</strong> Search and pagination ready</div>
        <div><strong>&gt;</strong> Admin dashboard secured</div>
      </div>
    </div>

    <div class="stats-grid">
      <div class="stat-card">
        <h3>{{ $posts->count() }}</h3>
        <p>Loaded Posts</p>
      </div>

      <div class="stat-card">
        <h3>CMS</h3>
        <p>Blog System</p>
      </div>

      <div class="stat-card">
        <h3>CRUD</h3>
        <p>Admin Features</p>
      </div>

      <div class="stat-card">
        <h3>DB</h3>
        <p>Dynamic Content</p>
      </div>
    </div>
  </div>
</section>

<section class="section">
  <div class="section-head">
    <div>
      <h2 class="small-title">Trending</h2>
      <p class="section-intro">Latest highlighted posts from the Alpha Nerd cyber feed.</p>
    </div>
  </div>

  <div class="slider-wrap">
    <button class="slider-btn left" type="button" aria-label="Scroll left" onclick="scrollTrending(-1)">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M15 18 9 12l6-6"></path>
      </svg>
    </button>

    <div class="slider" id="trendingSlider">
      @forelse($posts->take(6) as $post)
        <article class="slide">
          <a href="{{ route('posts.show', $post) }}" style="display:block; color:inherit;">
            @if($post->image)
              <img class="thumb" src="{{ asset($post->image) }}" alt="{{ $post->title }}">
            @else
              <div class="thumb"></div>
            @endif

            <h4>{{ \Illuminate\Support\Str::limit($post->title, 42) }}</h4>
            <p>{{ \Illuminate\Support\Str::limit($post->content, 80) }}</p>
          </a>
        </article>
      @empty
        <p class="muted" style="margin:0;">No posts available yet.</p>
      @endforelse
    </div>

    <button class="slider-btn right" type="button" aria-label="Scroll right" onclick="scrollTrending(1)">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="m9 18 6-6-6-6"></path>
      </svg>
    </button>
  </div>
</section>

<section class="section">
  <div class="section-head">
    <div>
      <h2 class="small-title">Latest Posts</h2>
      <p class="section-intro">Fresh content with category, author, date, and short preview.</p>
    </div>

    <a class="btn-outline" href="{{ route('search') }}">Search All</a>
  </div>

  <div class="post-list">
    @forelse($posts as $post)
      <article class="post-card latest-card">
        <a class="latest-thumb" href="{{ route('posts.show', $post) }}">
          @if($post->image)
            <img class="thumb" src="{{ asset($post->image) }}" alt="{{ $post->title }}">
          @else
            <div class="thumb"></div>
          @endif
        </a>

        <div class="latest-content">
          <span class="badge">
            <span class="dot"></span>
            {{ $post->category?->name ?? 'General' }}
          </span>

          <a href="{{ route('posts.show', $post) }}">
            <h3 class="title">{{ $post->title }}</h3>
          </a>

          <div class="meta">
            <span>{{ $post->created_at->toFormattedDateString() }}</span>
            <span>by {{ $post->author?->name ?? 'Admin' }}</span>
          </div>

          <p class="excerpt">{{ \Illuminate\Support\Str::limit($post->content, 150) }}</p>
        </div>
      </article>
    @empty
      <p class="muted" style="margin:0;">No posts found.</p>
    @endforelse
  </div>
</section>

@endsection

@push('scripts')
<script>
  function scrollTrending(dir){
    const el = document.getElementById("trendingSlider");
    if(!el) return;

    const amount = Math.round(el.clientWidth * 0.75) * dir;
    el.scrollBy({ left: amount, behavior: "smooth" });
  }
</script>
@endpush
