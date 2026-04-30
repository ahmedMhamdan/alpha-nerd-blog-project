@extends('site.layout')

@section('title', $post->title . ' | Alpha Nerd')

@push('styles')
<style>
  .post-page{
    display:grid;
    grid-template-columns:minmax(0, 1fr) 320px;
    gap:24px;
    align-items:start;
  }

  .post-hero-modern{
    padding:0;
    overflow:hidden;
  }

  .post-cover{
    position:relative;
    min-height:340px;
    display:flex;
    align-items:flex-end;
    padding:28px;
    border-bottom:1px solid rgba(163,230,53,.14);
    background:
      linear-gradient(180deg, transparent, rgba(7,11,10,.92)),
      radial-gradient(circle at 20% 0%, rgba(163,230,53,.16), transparent 40%),
      linear-gradient(135deg, #122018, #070B0A);
  }

  .post-cover img{
    position:absolute;
    inset:0;
    width:100%;
    height:100%;
    object-fit:cover;
    opacity:.42;
  }

  .post-cover::after{
    content:"";
    position:absolute;
    inset:0;
    background:
      linear-gradient(180deg, rgba(7,11,10,.12), rgba(7,11,10,.92)),
      radial-gradient(circle at 50% 10%, rgba(163,230,53,.10), transparent 45%);
  }

  .post-cover-content{
    position:relative;
    z-index:2;
    max-width:900px;
  }

  .post-title{
    margin:16px 0 12px;
    font-family:'Orbitron', sans-serif;
    font-size:clamp(32px, 4.5vw, 58px);
    line-height:1.08;
    letter-spacing:-1px;
    font-weight:900;
  }

  .post-title span{
    color:var(--accent);
  }

  .post-content-wrap{
    padding:28px;
  }

  .post-body{
    color:var(--soft);
    font-size:15px;
    line-height:2;
  }

  .post-body p{
    white-space:pre-wrap;
    margin:0;
  }

  .post-sidebar{
    position:sticky;
    top:100px;
    display:flex;
    flex-direction:column;
    gap:16px;
  }

  .side-card{
    border:1px solid rgba(163,230,53,.14);
    border-radius:22px;
    background:rgba(7,11,10,.48);
    padding:18px;
  }

  .side-title{
    margin:0 0 12px;
    font-family:'Orbitron', sans-serif;
    font-size:15px;
    text-transform:uppercase;
    letter-spacing:.4px;
  }

  .side-list{
    display:flex;
    flex-direction:column;
    gap:12px;
  }

  .side-item{
    display:flex;
    justify-content:space-between;
    gap:12px;
    color:var(--muted);
    font-size:12px;
    line-height:1.6;
    border-bottom:1px solid rgba(163,230,53,.08);
    padding-bottom:10px;
  }

  .side-item:last-child{
    border-bottom:0;
    padding-bottom:0;
  }

  .side-item strong{
    color:var(--text);
  }

  .comment-section{
    margin-top:24px;
  }

  .comment-head{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    gap:14px;
    flex-wrap:wrap;
    margin-bottom:16px;
  }

  .comment-form-box{
    margin-top:16px;
    padding:16px;
    border:1px solid rgba(163,230,53,.14);
    border-radius:20px;
    background:rgba(7,11,10,.38);
  }

  .comment-form-actions{
    display:flex;
    gap:10px;
    margin-top:12px;
    flex-wrap:wrap;
  }

  .alert-error{
    margin-top:12px;
    padding:12px 14px;
    border:1px solid rgba(251,113,133,.30);
    border-radius:14px;
    background:rgba(251,113,133,.09);
    color:#fecdd3;
    font-size:12px;
    line-height:1.7;
    font-weight:800;
  }

  .alert-error ul{
    margin:0;
    padding-left:18px;
  }

  .empty-comments{
    margin-top:14px;
    padding:24px;
    text-align:center;
    border:1px dashed rgba(163,230,53,.22);
    border-radius:20px;
    background:rgba(7,11,10,.30);
  }

  .empty-comments h3{
    margin:0 0 8px;
    font-family:'Orbitron', sans-serif;
    font-size:18px;
  }

  .empty-comments p{
    margin:0;
    color:var(--muted);
    font-size:12px;
    line-height:1.7;
  }

  .comment-success{
    margin-top:12px;
  }

  @media (max-width:1020px){
    .post-page{
      grid-template-columns:1fr;
    }

    .post-sidebar{
      position:static;
      display:grid;
      grid-template-columns:repeat(2, 1fr);
    }
  }

  @media (max-width:650px){
    .post-cover{
      min-height:280px;
      padding:22px;
    }

    .post-content-wrap{
      padding:22px;
    }

    .post-sidebar{
      grid-template-columns:1fr;
    }

    .post-title{
      font-size:31px;
    }
  }
</style>
@endpush

@section('content')

<div class="post-page">

  <article class="section post-hero-modern">
    <div class="post-cover">
      @if($post->image)
        <img src="{{ asset($post->image) }}" alt="{{ $post->title }}">
      @endif

      <div class="post-cover-content">
        <span class="badge">
          <span class="dot"></span>
          {{ $post->category?->name ?? 'General' }}
        </span>

        <h1 class="post-title">{{ $post->title }}</h1>

        <div class="meta">
          <span>{{ $post->created_at->toFormattedDateString() }}</span>
          <span>by {{ $post->author?->name ?? 'Admin' }}</span>
        </div>
      </div>
    </div>

    <div class="post-content-wrap">
      <div class="post-body">
        <p>{{ $post->content }}</p>
      </div>
    </div>
  </article>

  <aside class="post-sidebar">
    <div class="side-card">
      <h3 class="side-title">Post Info</h3>

      <div class="side-list">
        <div class="side-item">
          <span>Category</span>
          <strong>{{ $post->category?->name ?? 'General' }}</strong>
        </div>

        <div class="side-item">
          <span>Author</span>
          <strong>{{ $post->author?->name ?? 'Admin' }}</strong>
        </div>

        <div class="side-item">
          <span>Published</span>
          <strong>{{ $post->created_at->format('M d, Y') }}</strong>
        </div>

        <div class="side-item">
          <span>Comments</span>
          <strong>{{ $post->comments->count() }}</strong>
        </div>
      </div>
    </div>

    <div class="side-card">
      <h3 class="side-title">Actions</h3>

      <div style="display:flex; flex-direction:column; gap:10px;">
        <a class="btn-outline" href="{{ route('search') }}">Search Posts</a>
        <a class="btn-outline" href="{{ route('categories') }}">Browse Categories</a>
        <a class="btn-outline" href="{{ route('home') }}">Back Home</a>
      </div>
    </div>
  </aside>

</div>

<section class="section comment-section">
  <div class="comment-head">
    <div>
      <h2 class="small-title">Comments</h2>
      <p class="muted" style="margin:0;">Join the discussion and leave your thoughts on this post.</p>
    </div>

    @guest
      <a class="btn-outline" href="{{ route('login') }}">Sign in to comment</a>
    @endguest
  </div>

  @if(session('success'))
    <div class="comment-success">{{ session('success') }}</div>
  @endif

  @if ($errors->any())
    <div class="alert-error">
      <ul>
        @foreach($errors->all() as $e)
          <li>{{ $e }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  @auth
    <form class="comment-form-box" action="{{ route('comments.store', $post) }}" method="POST">
      @csrf

      <label for="content">Write a comment</label>
      <textarea
        id="content"
        name="content"
        class="c-input"
        placeholder="Type your comment..."
      >{{ old('content') }}</textarea>

      <div class="comment-form-actions">
        <button class="c-btn" type="submit">Post Comment</button>
      </div>
    </form>
  @endauth

  <div class="c-list">
    @forelse($post->comments as $c)
      <div class="c-card">
        <div class="c-head">
          <strong class="c-name">{{ $c->user?->name ?? 'User' }}</strong>
          <span class="c-time">{{ $c->created_at->diffForHumans() }}</span>
        </div>

        <p class="c-body">{{ $c->content }}</p>

        <div class="c-actions">
          @auth
            @if(auth()->user()->is_admin || auth()->id() === $c->user_id)
              <form method="POST" action="{{ route('comments.destroy', $c) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="c-del">Delete</button>
              </form>
            @endif
          @endauth
        </div>
      </div>
    @empty
      <div class="empty-comments">
        <h3>No comments yet</h3>
        <p>Be the first one to start the discussion.</p>
      </div>
    @endforelse
  </div>
</section>

@endsection
