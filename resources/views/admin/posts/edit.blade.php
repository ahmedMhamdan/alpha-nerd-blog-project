@extends('admin.layouts.adminlte')

@section('title','Edit Post')
@section('heading','Edit Post')

@section('content')

@if ($errors->any())
  <div class="alert alert-danger">
    <strong>Fix these errors:</strong>
    <ul class="mb-0 mt-2">
      @foreach($errors->all() as $e)
        <li>{{ $e }}</li>
      @endforeach
    </ul>
  </div>
@endif

<div class="card card-primary card-outline">
  <div class="card-header">
    <div class="d-flex justify-content-between align-items-center">
      <h3 class="card-title mb-0">Edit Post</h3>
      <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary btn-sm">Back</a>
    </div>
  </div>

  <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="card-body">
      <div class="mb-3">
        <label class="form-label">Title</label>
        <input
          type="text"
          class="form-control"
          name="title"
          value="{{ old('title', $post->title) }}"
          placeholder="Post title..."
        >
      </div>

      <div class="mb-3">
        <label class="form-label">Category</label>
        <select name="category_id" class="form-select">
          <option value="">-- None --</option>
          @foreach($categories as $cat)
            <option value="{{ $cat->id }}" @selected(old('category_id', $post->category_id) == $cat->id)>
              {{ $cat->name }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Current Image</label>

        @php
          $imagePath = $post->image ? ltrim($post->image, '/') : null;
          $imageExists = $imagePath && file_exists(public_path($imagePath));
        @endphp

        @if($imageExists)
          <div class="mb-2">
            <img
              src="{{ asset($imagePath) }}"
              alt="Post image"
              style="max-width:340px; width:100%; border-radius:12px; border:1px solid rgba(0,0,0,.12);"
            >
          </div>
          <div class="form-text">Leave image empty to keep the current one.</div>
        @elseif($post->image)
          <div class="alert alert-warning py-2 mb-2">
            Image path exists in database, but the image file is missing.
          </div>
          <div class="form-text">Upload a new image to replace the missing one.</div>
        @else
          <div class="text-muted small">No image uploaded.</div>
        @endif
      </div>

      <div class="mb-3">
        <label class="form-label">Replace Image</label>
        <input class="form-control" type="file" name="image" accept="image/*">
        <div class="form-text">jpg / jpeg / png / webp up to 2MB</div>
      </div>

      <div class="mb-0">
        <label class="form-label">Content</label>
        <textarea name="content" class="form-control" rows="10" placeholder="Write your post...">{{ old('content', $post->content) }}</textarea>
      </div>
    </div>

    <div class="card-footer">
      <button class="btn btn-primary" type="submit">Update</button>
      <a class="btn btn-outline-secondary" href="{{ route('admin.posts.index') }}">Cancel</a>
    </div>
  </form>
</div>

@endsection
