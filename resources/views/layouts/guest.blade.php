<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Alpha Nerd') }}</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700;800;900&family=Noto+Sans+Mono:wght@400;600;700;800&display=swap" rel="stylesheet">

  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <style>
    :root{
      --bg:#070B0A;
      --bg-2:#0B1110;
      --surface:#101915;
      --surface-2:#0B1210;
      --text:#EAF7EF;
      --muted:#9BB6A6;
      --soft:#C7D8CE;
      --border:#263A31;
      --accent:#A3E635;
      --accent-2:#22C55E;
      --danger:#FB7185;
    }

    *{
      box-sizing:border-box;
    }

    body{
      margin:0;
      min-height:100vh;
      font-family:"Noto Sans Mono", ui-monospace, monospace;
      color:var(--text);
      background:
        radial-gradient(circle at 18% 0%, rgba(163,230,53,.13), transparent 30%),
        radial-gradient(circle at 85% 15%, rgba(34,197,94,.10), transparent 30%),
        linear-gradient(135deg, var(--bg), var(--bg-2));
      overflow-x:hidden;
    }

    body::before{
      content:"";
      position:fixed;
      inset:0;
      pointer-events:none;
      background-image:
        linear-gradient(rgba(163,230,53,.035) 1px, transparent 1px),
        linear-gradient(90deg, rgba(163,230,53,.035) 1px, transparent 1px);
      background-size:44px 44px;
      mask-image:linear-gradient(to bottom, rgba(0,0,0,.8), transparent 78%);
      z-index:-2;
    }

    body::after{
      content:"";
      position:fixed;
      inset:0;
      pointer-events:none;
      background:
        radial-gradient(circle at 50% 0%, rgba(163,230,53,.08), transparent 34%),
        linear-gradient(180deg, transparent, rgba(0,0,0,.30));
      z-index:-1;
    }

    a{
      color:inherit;
    }

    .auth-shell{
      min-height:100vh;
      display:grid;
      place-items:center;
      padding:34px 18px;
    }

    .auth-container{
      width:min(100%, 1020px);
      display:grid;
      grid-template-columns:1fr 460px;
      gap:28px;
      align-items:center;
    }

    .auth-brand{
      padding:34px;
      border:1px solid rgba(163,230,53,.14);
      border-radius:28px;
      background:
        radial-gradient(circle at 10% 0%, rgba(163,230,53,.12), transparent 36%),
        rgba(7,11,10,.42);
      box-shadow:0 22px 70px rgba(0,0,0,.36);
    }

    .brand-badge{
      width:52px;
      height:52px;
      display:grid;
      place-items:center;
      border-radius:18px;
      background:linear-gradient(135deg, var(--accent), var(--accent-2));
      color:#07100B;
      font-family:"Orbitron", sans-serif;
      font-weight:900;
      box-shadow:0 0 34px rgba(163,230,53,.24);
    }

    .brand-title{
      margin:22px 0 12px;
      font-family:"Orbitron", sans-serif;
      font-size:clamp(36px, 4vw, 58px);
      line-height:1;
      text-transform:uppercase;
      letter-spacing:-1px;
    }

    .brand-title span{
      color:var(--accent);
      text-shadow:0 0 34px rgba(163,230,53,.22);
    }

    .brand-text{
      margin:0;
      color:var(--soft);
      font-size:14px;
      line-height:1.9;
      max-width:520px;
    }

    .brand-list{
      margin:24px 0 0;
      display:grid;
      grid-template-columns:repeat(2, 1fr);
      gap:12px;
    }

    .brand-item{
      padding:14px;
      border:1px solid rgba(163,230,53,.14);
      border-radius:18px;
      background:rgba(7,11,10,.40);
      color:var(--muted);
      font-size:12px;
      font-weight:900;
    }

    .brand-item strong{
      display:block;
      color:var(--accent);
      font-family:"Orbitron", sans-serif;
      font-size:16px;
      margin-bottom:5px;
    }

    .auth-card{
      border:1px solid rgba(163,230,53,.16);
      border-radius:26px;
      background:
        radial-gradient(circle at 10% 0%, rgba(163,230,53,.10), transparent 35%),
        linear-gradient(180deg, rgba(16,25,21,.94), rgba(11,18,16,.92));
      box-shadow:0 22px 70px rgba(0,0,0,.42);
      overflow:hidden;
    }

    .auth-card-top{
      padding:16px 18px;
      display:flex;
      align-items:center;
      gap:7px;
      border-bottom:1px solid rgba(163,230,53,.12);
      background:rgba(255,255,255,.03);
    }

    .auth-dot{
      width:10px;
      height:10px;
      border-radius:999px;
      background:var(--accent);
      box-shadow:0 0 14px rgba(163,230,53,.75);
    }

    .auth-card-body{
      padding:26px;
    }

    .auth-title{
      margin:0 0 8px;
      font-family:"Orbitron", sans-serif;
      font-size:25px;
      text-transform:uppercase;
      letter-spacing:.4px;
    }

    .auth-subtitle{
      margin:0 0 22px;
      color:var(--muted);
      font-size:12px;
      line-height:1.8;
    }

    .auth-form{
      display:flex;
      flex-direction:column;
      gap:15px;
    }

    .form-group label{
      display:block;
      margin-bottom:7px;
      color:var(--soft);
      font-size:12px;
      font-weight:900;
    }

    .auth-input{
      width:100%;
      min-height:46px;
      border:1px solid rgba(163,230,53,.15);
      background:rgba(7,11,10,.54);
      color:var(--text);
      border-radius:15px;
      padding:0 14px;
      outline:0;
      font-family:inherit;
      font-size:13px;
      transition:.18s ease;
    }

    .auth-input:focus{
      border-color:rgba(163,230,53,.48);
      box-shadow:0 0 0 4px rgba(163,230,53,.08);
    }

    .auth-error{
      margin-top:7px;
      color:#ffb4b4;
      font-size:11px;
      line-height:1.6;
    }

    .auth-error ul{
      margin:0;
      padding-left:18px;
    }

    .auth-status{
      margin-bottom:16px;
      padding:12px 14px;
      border:1px solid rgba(163,230,53,.25);
      border-radius:14px;
      background:rgba(163,230,53,.10);
      color:#D9F99D;
      font-size:12px;
      line-height:1.7;
      font-weight:800;
    }

    .auth-row{
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap:12px;
      flex-wrap:wrap;
      margin-top:4px;
    }

    .remember{
      display:flex;
      align-items:center;
      gap:8px;
      color:var(--muted);
      font-size:12px;
      font-weight:800;
    }

    .remember input{
      width:16px;
      height:16px;
      accent-color:var(--accent);
    }

    .auth-link{
      color:var(--muted);
      font-size:12px;
      font-weight:900;
      text-decoration:none;
      transition:.18s ease;
    }

    .auth-link:hover{
      color:var(--accent);
    }

    .auth-btn{
      min-height:44px;
      display:inline-flex;
      align-items:center;
      justify-content:center;
      border:0;
      border-radius:999px;
      padding:0 18px;
      color:#07100B;
      background:linear-gradient(135deg, var(--accent), var(--accent-2));
      font-family:"Orbitron", sans-serif;
      font-size:12px;
      font-weight:900;
      letter-spacing:.8px;
      text-transform:uppercase;
      cursor:pointer;
      box-shadow:0 14px 36px rgba(163,230,53,.18);
      transition:.18s ease;
    }

    .auth-btn:hover{
      transform:translateY(-1px);
      filter:brightness(1.05);
      box-shadow:0 18px 45px rgba(163,230,53,.24);
    }

    .auth-btn.dark{
      color:var(--text);
      background:rgba(7,11,10,.60);
      border:1px solid rgba(163,230,53,.18);
      box-shadow:none;
    }

    .auth-footer-note{
      margin-top:18px;
      padding-top:16px;
      border-top:1px solid rgba(163,230,53,.10);
      color:var(--muted);
      font-size:11px;
      line-height:1.7;
    }

    @media (max-width:920px){
      .auth-container{
        grid-template-columns:1fr;
        max-width:540px;
      }

      .auth-brand{
        display:none;
      }
    }

    @media (max-width:560px){
      .auth-shell{
        padding:20px 14px;
      }

      .auth-card-body{
        padding:21px;
      }

      .auth-row{
        align-items:stretch;
      }

      .auth-btn{
        width:100%;
      }

      .brand-list{
        grid-template-columns:1fr;
      }
    }
    /* Auth Header */

.auth-header{
  position:fixed;
  top:0;
  left:0;
  right:0;
  z-index:50;
  height:76px;
  border-bottom:1px solid rgba(163,230,53,.14);
  background:rgba(7,11,10,.78);
  backdrop-filter:blur(16px);
}

.auth-header-inner{
  width:min(1220px, calc(100% - 48px));
  height:100%;
  margin:0 auto;
  display:flex;
  align-items:center;
  justify-content:space-between;
  gap:18px;
}

.auth-logo{
  display:flex;
  align-items:center;
  gap:11px;
  text-decoration:none;
  color:var(--text);
  font-family:"Orbitron", sans-serif;
  font-weight:900;
  letter-spacing:.6px;
  text-transform:uppercase;
}

.auth-logo-badge{
  width:40px;
  height:40px;
  display:grid;
  place-items:center;
  border-radius:14px;
  background:linear-gradient(135deg, var(--accent), var(--accent-2));
  color:#07100B;
  box-shadow:0 0 28px rgba(163,230,53,.22);
}

.auth-logo-text{
  display:flex;
  flex-direction:column;
  line-height:1.05;
  font-size:15px;
}

.auth-logo-text span{
  color:var(--accent);
}

.auth-nav{
  display:flex;
  align-items:center;
  gap:8px;
}

.auth-nav a{
  min-height:40px;
  display:inline-flex;
  align-items:center;
  justify-content:center;
  padding:0 14px;
  border-radius:999px;
  color:var(--muted);
  text-decoration:none;
  font-size:12px;
  font-weight:900;
  transition:.18s ease;
}

.auth-nav a:hover,
.auth-nav a.active{
  color:var(--text);
  background:rgba(163,230,53,.10);
  border:1px solid rgba(163,230,53,.20);
}

.auth-shell{
  padding-top:110px !important;
}

@media (max-width:620px){
  .auth-header-inner{
    width:min(100% - 28px, 1220px);
  }

  .auth-logo-text{
    font-size:13px;
  }

  .auth-nav a{
    padding:0 10px;
    font-size:11px;
  }
}
  </style>
</head>
<body>
    <header class="auth-header">
  <div class="auth-header-inner">

    <a class="auth-logo" href="{{ route('home') }}">
      <span class="auth-logo-badge">A</span>
      <span class="auth-logo-text">
        <span>Alpha</span>
        Nerd
      </span>
    </a>

    <nav class="auth-nav">
      <a href="{{ route('home') }}">
        Home
      </a>

      @if (Route::has('login'))
        <a class="{{ request()->routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}">
          Login
        </a>
      @endif

      @if (Route::has('register'))
        <a class="{{ request()->routeIs('register') ? 'active' : '' }}" href="{{ route('register') }}">
          Register
        </a>
      @endif
    </nav>

  </div>
</header>
  <div class="auth-shell">
    <div class="auth-container">

      <aside class="auth-brand">
        <div class="brand-badge">A</div>

        <h1 class="brand-title">
          Alpha <span>Nerd</span>
        </h1>

        <p class="brand-text">
          Laravel cybersecurity blog and admin CMS with authentication, CRUD,
          comments, contact messages, search, pagination, image upload, and soft delete workflows.
        </p>

        <div class="brand-list">
          <div class="brand-item">
            <strong>CMS</strong>
            Blog Management
          </div>

          <div class="brand-item">
            <strong>CRUD</strong>
            Admin Dashboard
          </div>

          <div class="brand-item">
            <strong>Auth</strong>
            Laravel Breeze
          </div>

          <div class="brand-item">
            <strong>Cyber</strong>
            Security Theme
          </div>
        </div>
      </aside>

      <main class="auth-card">
        <div class="auth-card-top">
          <span class="auth-dot"></span>
          <span class="auth-dot"></span>
          <span class="auth-dot"></span>
        </div>

        <div class="auth-card-body">
          {{ $slot }}
        </div>
      </main>

    </div>
  </div>
</body>
</html>
