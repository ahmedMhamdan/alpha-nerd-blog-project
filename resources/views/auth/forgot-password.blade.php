<x-guest-layout>
  <h2 class="auth-title">Reset Password</h2>
  <p class="auth-subtitle">
    Forgot your password? Enter your email and Laravel will send a reset link if email service is configured.
  </p>

  @if (session('status'))
    <div class="auth-status">
      {{ session('status') }}
    </div>
  @endif

  <form method="POST" action="{{ route('password.email') }}" class="auth-form">
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
        placeholder="name@example.com"
      >

      @error('email')
        <div class="auth-error">{{ $message }}</div>
      @enderror
    </div>

    <div class="auth-row">
      <a class="auth-link" href="{{ route('login') }}">
        Back to login
      </a>

      <button type="submit" class="auth-btn">
        Send Reset Link
      </button>
    </div>

    <div class="auth-footer-note">
      In local development, password reset requires mail configuration in the .env file.
    </div>
  </form>
</x-guest-layout>
