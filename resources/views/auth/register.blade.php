<x-guest-layout>
  <h2 class="auth-title">Register</h2>
  <p class="auth-subtitle">
    Create a new Alpha Nerd account to join the platform and interact with posts.
  </p>

  <form method="POST" action="{{ route('register') }}" class="auth-form">
    @csrf

    <div class="form-group">
      <label for="name">Name</label>
      <input
        id="name"
        class="auth-input"
        type="text"
        name="name"
        value="{{ old('name') }}"
        required
        autofocus
        autocomplete="name"
        placeholder="Your name"
      >

      @error('name')
        <div class="auth-error">{{ $message }}</div>
      @enderror
    </div>

    <div class="form-group">
      <label for="email">Email</label>
      <input
        id="email"
        class="auth-input"
        type="email"
        name="email"
        value="{{ old('email') }}"
        required
        autocomplete="username"
        placeholder="name@example.com"
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
        autocomplete="new-password"
        placeholder="Create a password"
      >

      @error('password')
        <div class="auth-error">{{ $message }}</div>
      @enderror
    </div>

    <div class="form-group">
      <label for="password_confirmation">Confirm Password</label>
      <input
        id="password_confirmation"
        class="auth-input"
        type="password"
        name="password_confirmation"
        required
        autocomplete="new-password"
        placeholder="Confirm your password"
      >

      @error('password_confirmation')
        <div class="auth-error">{{ $message }}</div>
      @enderror
    </div>

    <div class="auth-row">
      <a class="auth-link" href="{{ route('login') }}">
        Already registered?
      </a>

      <button type="submit" class="auth-btn">
        Register
      </button>
    </div>

    <div class="auth-footer-note">
      New users are created through Laravel Breeze and stored in the users table.
    </div>
  </form>
</x-guest-layout>
