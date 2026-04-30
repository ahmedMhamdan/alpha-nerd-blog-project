<!doctype html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title', 'Alpha Nerd')</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700;800;900&family=Noto+Sans+Mono:wght@400;600;700;800&display=swap" rel="stylesheet">
    <script>
  (function () {
    const savedTheme = localStorage.getItem('alpha_theme') || 'dark';
    document.documentElement.setAttribute('data-theme', savedTheme);
  })();
</script>
  <link rel="stylesheet" href="{{ asset('site/style.css') }}">

  @stack('styles')
</head>
<body>

<header class="header">
  <div class="container header-inner">

    <a class="logo" href="{{ route('home') }}">
      <span class="logo-badge">A</span>
      <span class="logo-text"><span>Alpha</span> Nerd</span>
    </a>

    <nav class="nav-icons" aria-label="Primary Navigation">

      <a class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
        <svg class="nav-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M3 10.5 12 3l9 7.5"></path>
          <path d="M5 10v10h14V10"></path>
        </svg>
        <span class="nav-label">Home</span>
      </a>

      <a class="nav-item {{ request()->routeIs('categories') ? 'active' : '' }}" href="{{ route('categories') }}">
        <svg class="nav-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M4 4h7v7H4z"></path>
          <path d="M13 4h7v7h-7z"></path>
          <path d="M4 13h7v7H4z"></path>
          <path d="M13 13h7v7h-7z"></path>
        </svg>
        <span class="nav-label">Categories</span>
      </a>

      <a class="nav-item {{ request()->routeIs('search') ? 'active' : '' }}" href="{{ route('search') }}">
        <svg class="nav-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="11" cy="11" r="7"></circle>
          <path d="M21 21l-4.3-4.3"></path>
        </svg>
        <span class="nav-label">Search</span>
      </a>

      <a class="nav-item {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">
        <svg class="nav-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M4 4h16v16H4z"></path>
          <path d="m4 6 8 7 8-7"></path>
        </svg>
        <span class="nav-label">Contact</span>
      </a>

    </nav>

    <div class="actions">
        <button class="theme-toggle" type="button" id="themeToggle" aria-label="Toggle theme">
  <span class="theme-icon theme-sun">☀</span>
  <span class="theme-icon theme-moon">☾</span>
</button>
      @auth
        @if(auth()->user()->is_admin)
          <a class="admin-btn" href="{{ route('admin.dashboard') }}">Dashboard</a>
        @endif

        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button class="btn-outline" type="submit">Logout</button>
        </form>
      @endauth

      @guest
        <a class="link" href="{{ route('register') }}">Join</a>
        <a class="btn-outline" href="{{ route('login') }}">Sign in</a>
      @endguest
    </div>

  </div>
</header>

<main class="page">
  <div class="content">
    @yield('content')
  </div>
</main>

<footer class="footer">
  <div class="container">
    © {{ date('Y') }} Alpha Nerd — Cyber Blog & CMS
  </div>
</footer>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const root = document.documentElement;
    const toggle = document.getElementById('themeToggle');

    if (!toggle) return;

    toggle.addEventListener('click', function () {
      const current = root.getAttribute('data-theme') || 'dark';
      const next = current === 'dark' ? 'light' : 'dark';

      root.setAttribute('data-theme', next);
      localStorage.setItem('alpha_theme', next);
    });
  });
</script>
@stack('scripts')
</body>
</html>
