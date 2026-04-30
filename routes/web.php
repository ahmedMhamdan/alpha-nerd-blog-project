<?php

use Illuminate\Support\Facades\Route;

use App\Models\Post;
use App\Models\Category;

use App\Http\Controllers\ContactController;
use App\Http\Controllers\CommentController;

use App\Http\Controllers\PostController;                 // Admin Posts CRUD
use App\Http\Controllers\Admin\CategoryController;       // Admin Categories CRUD
use App\Http\Controllers\Admin\MessageController;        // Admin Messages inbox
use App\Http\Controllers\Admin\DashboardController;      // Admin Dashboard

use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Public site
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $posts = Post::orderBy('id' , 'desc')->take(10)->get();
    return view('site.home', compact('posts'));
})->name('home');

Route::get('/categories', function () {
    $categories = Category::orderBy('name')->get();

    $cat = request('cat');
    $postsQuery = Post::latest();

    if ($cat) {
        $postsQuery->whereHas('category', fn ($q) => $q->where('name', $cat));
    }

    $posts = $postsQuery->paginate(10)->appends(['cat' => $cat]);

    return view('site.category', compact('categories', 'posts', 'cat'));
})->name('categories');

Route::get('/posts/{post}', function (Post $post) {
    $post->load(['category', 'comments.user']);
    return view('site.post', compact('post'));
})->name('posts.show');

Route::get('/search', [PostController::class, 'search'])->name('search');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

/*
|--------------------------------------------------------------------------
| Comments (auth required)
|--------------------------------------------------------------------------
*/
Route::post('/posts/{post}/comments', [CommentController::class, 'store'])
    ->middleware('auth')
    ->name('comments.store');

Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])
    ->middleware('auth')
    ->name('comments.destroy');

/*
|--------------------------------------------------------------------------
| Admin (protected)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Posts
    Route::get('posts/deleted/list', [PostController::class, 'deleted'])->name('posts.deleted');
    Route::get('posts/deleted/{id}', [PostController::class, 'showDeleted'])->name('posts.deleted.show');
    Route::post('posts/deleted/{id}/restore', [PostController::class, 'restore'])->name('posts.restore');
    Route::delete('posts/deleted/{id}/force', [PostController::class, 'forceDelete'])->name('posts.forceDelete');
    Route::resource('posts', PostController::class);

    // Categories
    Route::get('categories/deleted/list', [CategoryController::class, 'deleted'])->name('categories.deleted');
    Route::get('categories/deleted/{id}', [CategoryController::class, 'showDeleted'])->name('categories.deleted.show');
    Route::post('categories/deleted/{id}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
    Route::delete('categories/deleted/{id}/force', [CategoryController::class, 'forceDelete'])->name('categories.forceDelete');
    Route::resource('categories', CategoryController::class);

    // Messages
    Route::get('messages/deleted/list', [MessageController::class, 'deleted'])->name('messages.deleted');
    Route::get('messages/deleted/{id}', [MessageController::class, 'showDeleted'])->name('messages.deleted.show');
    Route::post('messages/deleted/{id}/restore', [MessageController::class, 'restore'])->name('messages.restore');
    Route::delete('messages/deleted/{id}/force', [MessageController::class, 'forceDelete'])->name('messages.forceDelete');

    Route::get('messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('messages/{message}', [MessageController::class, 'show'])->name('messages.show');
    Route::delete('messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');
});

Route::get('/change-password', [ProfileController::class, 'edit'])
    ->middleware(['auth', 'admin'])
    ->name('profile.edit');

/*
|--------------------------------------------------------------------------
| Breeze default dashboard route
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return redirect()->route('home');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
