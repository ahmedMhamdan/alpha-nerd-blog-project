@extends('site.layout')

@section('title', 'Alpha Nerd | Contact')

@push('styles')
<style>
  .contact-hero{
    display:grid;
    grid-template-columns:1.1fr .9fr;
    gap:24px;
    align-items:stretch;
  }

  .contact-title{
    margin:0;
    font-family:'Orbitron', sans-serif;
    font-size:clamp(34px, 4vw, 58px);
    line-height:1.05;
    letter-spacing:-1px;
    text-transform:uppercase;
  }

  .contact-title span{
    color:var(--accent);
    text-shadow:0 0 34px rgba(163,230,53,.22);
  }

  .contact-text{
    max-width:760px;
    margin:18px 0 0;
    color:var(--soft);
    font-size:14px;
    line-height:1.9;
  }

  .contact-badges{
    display:flex;
    gap:10px;
    flex-wrap:wrap;
    margin-top:22px;
  }

  .contact-mini{
    display:inline-flex;
    align-items:center;
    gap:8px;
    padding:8px 12px;
    border-radius:999px;
    border:1px solid rgba(163,230,53,.18);
    background:rgba(7,11,10,.42);
    color:var(--muted);
    font-size:12px;
    font-weight:900;
  }

  .contact-terminal{
    border:1px solid rgba(163,230,53,.18);
    border-radius:22px;
    background:rgba(7,11,10,.52);
    overflow:hidden;
    box-shadow:0 0 42px rgba(163,230,53,.08);
  }

  .terminal-top{
    display:flex;
    align-items:center;
    gap:7px;
    padding:13px 15px;
    border-bottom:1px solid rgba(163,230,53,.12);
    background:rgba(255,255,255,.03);
  }

  .terminal-dot{
    width:10px;
    height:10px;
    border-radius:99px;
    background:var(--accent);
    box-shadow:0 0 14px rgba(163,230,53,.65);
  }

  .terminal-body{
    padding:18px;
    font-size:12px;
    line-height:1.9;
    color:var(--soft);
  }

  .terminal-body strong{
    color:var(--accent);
  }

  .contact-grid{
    display:grid;
    grid-template-columns:1.15fr .85fr;
    gap:24px;
    margin-top:24px;
  }

  .form-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:14px;
  }

  .form-group.full{
    grid-column:1 / -1;
  }

  .field-error{
    margin-top:7px;
    color:#ffb4b4;
    font-size:11px;
    line-height:1.5;
  }

  .alert-success,
  .alert-error{
    margin-bottom:16px;
    padding:13px 15px;
    border-radius:16px;
    font-size:12px;
    line-height:1.7;
    font-weight:800;
  }

  .alert-success{
    border:1px solid rgba(163,230,53,.25);
    background:rgba(163,230,53,.10);
    color:#D9F99D;
  }

  .alert-error{
    border:1px solid rgba(251,113,133,.30);
    background:rgba(251,113,133,.09);
    color:#fecdd3;
  }

  .alert-error ul{
    margin:0;
    padding-left:18px;
  }

  .contact-actions{
    display:flex;
    align-items:center;
    gap:12px;
    flex-wrap:wrap;
    margin-top:18px;
  }

  .info-stack{
    display:flex;
    flex-direction:column;
    gap:14px;
  }

  .contact-note{
    margin-top:14px;
    padding:15px;
    border:1px solid rgba(163,230,53,.14);
    border-radius:18px;
    background:rgba(7,11,10,.36);
    color:var(--muted);
    font-size:12px;
    line-height:1.8;
  }

  .info-row strong{
    color:var(--accent);
  }

  @media (max-width:980px){
    .contact-hero,
    .contact-grid{
      grid-template-columns:1fr;
    }
  }

  @media (max-width:620px){
    .form-grid{
      grid-template-columns:1fr;
    }

    .contact-title{
      font-size:34px;
    }
  }
</style>
@endpush

@section('content')

<section class="section contact-hero">
  <div>
    <div class="badge">
      <span class="dot"></span>
      Contact Channel
    </div>

    <h1 class="contact-title" style="margin-top:16px;">
      Let’s <span>Connect</span>
    </h1>

    <p class="contact-text">
      Have feedback, a question, or want to report an issue? Send a message through the form.
      The message will be validated by Laravel and stored directly in the database.
    </p>

    <div class="contact-badges">
      <span class="contact-mini">
        <span class="dot"></span>
        Laravel Validation
      </span>

      <span class="contact-mini">
        <span class="dot"></span>
        Database Storage
      </span>

      <span class="contact-mini">
        <span class="dot"></span>
        Admin Management
      </span>
    </div>
  </div>

  <div class="contact-terminal">
    <div class="terminal-top">
      <span class="terminal-dot"></span>
      <span class="terminal-dot"></span>
      <span class="terminal-dot"></span>
    </div>

    <div class="terminal-body">
      <div><strong>$</strong> contact_message::create()</div>
      <div><strong>&gt;</strong> validating name, email, subject...</div>
      <div><strong>&gt;</strong> storing message in database...</div>
      <div><strong>&gt;</strong> admin can review it from dashboard</div>
    </div>
  </div>
</section>

<section class="contact-grid">
  <section class="section">
    <div class="section-head">
      <div>
        <h2 class="small-title">Send Message</h2>
        <p class="muted" style="margin:0;">Fill the form and your message will be saved in the contact messages table.</p>
      </div>
    </div>

    @if (session('success'))
      <div class="alert-success">
        {{ session('success') }}
      </div>
    @endif

    @if ($errors->any())
      <div class="alert-error">
        <ul>
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('contact.store') }}" method="POST">
      @csrf

      <div class="form-grid">
        <div class="form-group">
          <label for="name">Name</label>
          <input
            class="input"
            id="name"
            name="name"
            type="text"
            placeholder="Your name"
            value="{{ old('name') }}"
          >
          @error('name')
            <div class="field-error">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input
            class="input"
            id="email"
            name="email"
            type="email"
            placeholder="name@example.com"
            value="{{ old('email') }}"
          >
          @error('email')
            <div class="field-error">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group full">
          <label for="subject">Subject</label>
          <input
            class="input"
            id="subject"
            name="subject"
            type="text"
            placeholder="What is this about?"
            value="{{ old('subject') }}"
          >
          @error('subject')
            <div class="field-error">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group full">
          <label for="message">Message</label>
          <textarea
            class="input"
            id="message"
            name="message"
            placeholder="Write your message..."
          >{{ old('message') }}</textarea>
          @error('message')
            <div class="field-error">{{ $message }}</div>
          @enderror
        </div>
      </div>

      <div class="contact-actions">
        <button class="btn primary" type="submit">Send Message</button>
        <a class="btn-outline" href="{{ route('home') }}">Back Home</a>
      </div>
    </form>
  </section>

  <aside class="section">
    <div class="section-head">
      <div>
        <h2 class="small-title">Info</h2>
        <p class="muted" style="margin:0;">Project contact details and response information.</p>
      </div>
    </div>

    <div class="info-stack">
      <div class="info-row">
        <div class="icon" aria-hidden="true">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M4 4h16v16H4z"></path>
            <path d="m4 6 8 7 8-7"></path>
          </svg>
        </div>

        <div>
          <h4>Email</h4>
          <p>admin@alphanerd.test</p>
        </div>
      </div>

      <div class="info-row">
        <div class="icon" aria-hidden="true">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 21s-6-4.35-6-10a6 6 0 1 1 12 0c0 5.65-6 10-6 10z"></path>
            <circle cx="12" cy="11" r="2.5"></circle>
          </svg>
        </div>

        <div>
          <h4>Location</h4>
          <p>Palestine</p>
        </div>
      </div>

      <div class="info-row">
        <div class="icon" aria-hidden="true">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 3v18"></path>
            <path d="M4 8h16"></path>
            <path d="M4 16h16"></path>
          </svg>
        </div>

        <div>
          <h4>Backend</h4>
          <p><strong>Laravel</strong> validation and database insert.</p>
        </div>
      </div>
    </div>
  </aside>
</section>

@endsection
