@extends('admin.layouts.adminlte')

@section('title', 'Change Password')
@section('heading', 'Change Password')

@section('content')

<div class="row">
  <div class="col-lg-8">

    <div class="card card-outline card-success">
      <div class="card-header">
        <h3 class="card-title mb-0">
          <i class="bi bi-shield-lock me-1"></i>
          Update Password
        </h3>
      </div>

      <div class="card-body">

        <p class="text-muted mb-4">
          Ensure your account is using a long, random password to stay secure.
        </p>

        @if (session('status') === 'password-updated')
          <div class="alert alert-success">
            Password updated successfully.
          </div>
        @endif

        @if ($errors->updatePassword->any())
          <div class="alert alert-danger">
            <ul class="mb-0">
              @foreach ($errors->updatePassword->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
          @csrf
          @method('PUT')

          <div class="mb-3">
            <label for="current_password" class="form-label">Current Password</label>
            <input
              type="password"
              id="current_password"
              name="current_password"
              class="form-control"
              autocomplete="current-password"
            >
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">New Password</label>
            <input
              type="password"
              id="password"
              name="password"
              class="form-control"
              autocomplete="new-password"
            >
          </div>

          <div class="mb-4">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input
              type="password"
              id="password_confirmation"
              name="password_confirmation"
              class="form-control"
              autocomplete="new-password"
            >
          </div>

          <div class="d-flex gap-2 flex-wrap">
            <button type="submit" class="btn btn-success">
              <i class="bi bi-check2-circle me-1"></i>
              Save
            </button>

            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
              <i class="bi bi-arrow-left me-1"></i>
              Back to Dashboard
            </a>
          </div>
        </form>

      </div>
    </div>

  </div>

  <div class="col-lg-4">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title mb-0">
          <i class="bi bi-info-circle me-1"></i>
          Security Tips
        </h3>
      </div>

      <div class="card-body">
        <ul class="mb-0 text-muted">
          <li class="mb-2">Use at least 8 characters.</li>
          <li class="mb-2">Mix letters, numbers, and symbols.</li>
          <li class="mb-2">Do not reuse old passwords.</li>
          <li>Keep your admin account protected.</li>
        </ul>
      </div>
    </div>
  </div>
</div>

@endsection
