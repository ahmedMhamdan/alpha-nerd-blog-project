<!doctype html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>@yield('title', 'Admin Dashboard') | Alpha Nerd</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
  <meta name="color-scheme" content="light dark" />
  <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
  <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />

<script>
  (function () {
    const savedTheme = localStorage.getItem('alpha_admin_theme') || 'dark';
    document.documentElement.setAttribute('data-admin-theme', savedTheme);
  })();
</script>

  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
    crossorigin="anonymous"
    media="print"
    onload="this.media='all'"
  />

  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
    crossorigin="anonymous"
  />

  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
    crossorigin="anonymous"
  />

  <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.css') }}" />
  <link rel="stylesheet" href="{{ asset('admin/css/admin-theme.css') }}">
  @stack('styles')
</head>

<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
<div class="app-wrapper">

  {{-- Header --}}
  <nav class="app-header navbar navbar-expand bg-body">
    <div class="container-fluid">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
            <i class="bi bi-list"></i>
          </a>
        </li>
        <li class="nav-item d-none d-md-block">
          <a href="{{ route('home') }}" class="nav-link">Website</a>
        </li>
      </ul>

<ul class="navbar-nav ms-auto align-items-center">
    <li class="nav-item me-2 d-flex align-items-center">
        <button class="admin-theme-toggle" type="button" id="adminThemeToggle" aria-label="Toggle dashboard theme">
            <span class="admin-theme-icon admin-theme-sun">☀</span>
            <span class="admin-theme-icon admin-theme-moon">☾</span>
        </button>
    </li>

    <li class="nav-item d-flex align-items-center">
        <form action="{{ route('logout') }}" method="POST" class="mb-0">
            @csrf
            <button type="submit" class="btn btn-outline-secondary btn-sm">Logout</button>
        </form>
    </li>
</ul>
    </div>
  </nav>

  {{-- Sidebar --}}
  <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
      <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img
          src="{{ asset('adminlte/assets/img/AdminLTELogo.png') }}"
          alt="Alpha Nerd Logo"
          class="brand-image opacity-75 shadow"
        />
        <span class="brand-text fw-light">Alpha Nerd Admin</span>
      </a>
    </div>

    <div class="sidebar-wrapper">
      <nav class="mt-2">
<ul
  class="nav sidebar-menu flex-column"
  data-lte-toggle="treeview"
  role="navigation"
  data-accordion="false"
>
  <li class="nav-item">
    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
      <i class="nav-icon bi bi-speedometer2"></i>
      <p>Dashboard</p>
    </a>
  </li>

  <li class="nav-item {{ request()->routeIs('admin.posts.*') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}">
      <i class="nav-icon bi bi-journal-text"></i>
      <p>
        Posts
        <i class="nav-arrow bi bi-chevron-right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{ route('admin.posts.index') }}" class="nav-link {{ request()->routeIs('admin.posts.index', 'admin.posts.create', 'admin.posts.edit') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>All Posts</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.posts.deleted') }}" class="nav-link {{ request()->routeIs('admin.posts.deleted', 'admin.posts.deleted.show') ? 'active' : '' }}">
          <i class="nav-icon bi bi-trash"></i>
          <p>Deleted Posts</p>
        </a>
      </li>
    </ul>
  </li>

  <li class="nav-item {{ request()->routeIs('admin.categories.*') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
      <i class="nav-icon bi bi-grid"></i>
      <p>
        Categories
        <i class="nav-arrow bi bi-chevron-right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.index', 'admin.categories.create', 'admin.categories.edit') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>All Categories</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.categories.deleted') }}" class="nav-link {{ request()->routeIs('admin.categories.deleted', 'admin.categories.deleted.show') ? 'active' : '' }}">
          <i class="nav-icon bi bi-trash"></i>
          <p>Deleted Categories</p>
        </a>
      </li>
    </ul>
  </li>

  <li class="nav-item {{ request()->routeIs('admin.messages.*') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
      <i class="nav-icon bi bi-envelope"></i>
      <p>
        Messages
        <i class="nav-arrow bi bi-chevron-right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{ route('admin.messages.index') }}" class="nav-link {{ request()->routeIs('admin.messages.index', 'admin.messages.show') ? 'active' : '' }}">
          <i class="nav-icon bi bi-circle"></i>
          <p>All Messages</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.messages.deleted') }}" class="nav-link {{ request()->routeIs('admin.messages.deleted', 'admin.messages.deleted.show') ? 'active' : '' }}">
          <i class="nav-icon bi bi-trash"></i>
          <p>Deleted Messages</p>
        </a>
      </li>
    </ul>
  </li>
  <li class="nav-item">
    <a href="{{ route('profile.edit') }}" class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
        <i class="nav-icon bi bi-key"></i>
        <p>Change Password</p>
    </a>
</li>
</ul>
      </nav>
    </div>
  </aside>

  {{-- Main --}}
  <main class="app-main">
    <div class="app-content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h3 class="mb-0">@yield('heading', 'Dashboard')</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">@yield('heading', 'Dashboard')</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <div class="app-content">
      <div class="container-fluid">
        @yield('content')
      </div>
    </div>
  </main>

  <footer class="app-footer">
    <div class="float-end d-none d-sm-inline">Alpha Nerd</div>
    <strong>
      Copyright &copy; {{ date('Y') }} - {{ date('Y') - 1 }}
      <a href="#" class="text-decoration-none">Alpha Nerd</a>.
    </strong>
    All rights reserved.
  </footer>
</div>

<script
  src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
  crossorigin="anonymous"
></script>

<script
  src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
  crossorigin="anonymous"
></script>

<script
  src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"
  crossorigin="anonymous"
></script>

<script src="{{ asset('adminlte/js/adminlte.js') }}"></script>

<script>
  const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
  const Default = {
    scrollbarTheme: 'os-theme-light',
    scrollbarAutoHide: 'leave',
    scrollbarClickScroll: true,
  };

  document.addEventListener('DOMContentLoaded', function () {
    const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);

    if (sidebarWrapper && OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined) {
      OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
        scrollbars: {
          theme: Default.scrollbarTheme,
          autoHide: Default.scrollbarAutoHide,
          clickScroll: Default.scrollbarClickScroll,
        },
      });
    }
  });
</script>
<script src="{{ asset('admin/js/admin-theme.js') }}"></script>
@stack('scripts')
</body>
</html>
