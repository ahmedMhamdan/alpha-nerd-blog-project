<x-guest-layout>
  <h2 class="auth-title">Login</h2>
  <p class="auth-subtitle">
    Access your Alpha Nerd account and continue managing the cyber blog experience.
  </p>

  @if (session('status'))
    <div class="auth-status">
      {{ session('status') }}
    </div>
  @endif

  <form method="POST" action="{{ route('login') }}" class="auth-form">
    @csrf

    <div class="form-group">
      <label for="email">Email</label>
      <input
        id="email"
        class="auth-input"
        type="email"
        name="email"
        value="{{ old('email') }}"
        required
        autofocus
        autocomplete="username"
        placeholder="admin@alphanerd.test"
      >

      @error('email')
        <div class="auth-error">{{ $message }}</div>
      @enderror
    </div>

    <div class="form-group">
      <label for="password">Password</label>
      <input
        id="password"
        class="auth-input"
        type="password"
        name="password"
        required
        autocomplete="current-password"
        placeholder="Enter your password"
      >

      @error('password')
        <div class="auth-error">{{ $message }}</div>
      @enderror
    </div>

    <div class="auth-row">
      <label class="remember" for="remember_me">
        <input id="remember_me" type="checkbox" name="remember">
        <span>Remember me</span>
      </label>

      @if (Route::has('password.request'))
        <a class="auth-link" href="{{ route('password.request') }}">
          Forgot password?
        </a>
      @endif
    </div>

    <div class="auth-row">
      <a class="auth-link" href="{{ route('register') }}">
        Create new account
      </a>

      <button type="submit" class="auth-btn">
        Log in
      </button>
    </div>

    <div class="auth-footer-note">
      This login system is powered by Laravel Breeze authentication.
    </div>
  </form>
</x-guest-layout>
