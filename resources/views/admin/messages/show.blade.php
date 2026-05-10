@extends('admin.layouts.adminlte')

@section('title','View Message')
@section('heading','View Message')

@section('content')

<div class="card admin-message-show">
  <div class="card-header">
    <div class="d-flex justify-content-between align-items-center">
      <h3 class="card-title mb-0">Message Details</h3>
      <a href="{{ route('admin.messages.index') }}" class="btn btn-outline-secondary btn-sm">Back</a>
    </div>
  </div>

  <div class="card-body">
    <p><strong>Name:</strong> {{ $message->name }}</p>
    <p><strong>Email:</strong> {{ $message->email }}</p>
    <p><strong>Subject:</strong> {{ $message->subject }}</p>

    <p><strong>Message:</strong></p>

    <div class="border rounded p-3 mb-3 admin-message-box">
      {!! nl2br(e($message->message)) !!}
    </div>

    <p><strong>Sent At:</strong> {{ $message->created_at }}</p>

    <div class="d-flex gap-2 flex-wrap">
      <form method="POST" action="{{ route('admin.messages.destroy', $message) }}">
        @csrf
        @method('DELETE')

        <button class="btn btn-danger" type="submit" onclick="return confirm('Delete this message?')">
          Delete
        </button>
      </form>
    </div>
  </div>
</div>

@endsection
