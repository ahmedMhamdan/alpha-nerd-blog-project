<?php

use Illuminate\Support\Facades\Route;

use App\Models\Post;
use App\Models\Category;

use App\Http\Controllers\ContactController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController as SitePostController;
use App\Http\Controllers\PostController as AdminPostController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\MessageController as AdminMessageController;
use App\Http\Controllers\Admin\DashboardController;

/*
|--------------------------------------------------------------------------
| Public site
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $posts = Post::query()
        ->orderBy('id', 'desc')
        ->take(10)
        ->get();

    return view('site.home', compact('posts'));
})->name('home');

Route::get('/categories', function () {
    $categories = Category::query()
        ->orderBy('name', 'asc')
        ->get();

    $cat = request('cat');

    $postsQuery = Post::query()
        ->orderBy('created_at', 'desc');

    if ($cat) {
        $postsQuery->whereHas('category', function ($q) use ($cat) {
            $q->where('name', $cat);
        });
    }

    $posts = $postsQuery->paginate(10)->appends(['cat' => $cat]);

    return view('site.category', compact('categories', 'posts', 'cat'));
})->name('categories');

Route::get('/posts/{post}', function (Post $post) {
    $post->load(['category', 'comments.user']);

    return view('site.post', compact('post'));
})->name('posts.show');

Route::get('/search', [SitePostController::class, 'search'])->name('search');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

/*
|--------------------------------------------------------------------------
| Authenticated user routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    Route::get('/dashboard', function () {
        return redirect()->route('home');
    })->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| Admin routes - protected by auth + admin middleware
|--------------------------------------------------------------------------
*/

Route::prefix('admin-panel')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/', function () {
            return redirect()->route('admin.dashboard');
        })->name('home');

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Posts
        Route::get('/posts/deleted/list', [AdminPostController::class, 'deleted'])->name('posts.deleted');
        Route::get('/posts/deleted/{id}', [AdminPostController::class, 'showDeleted'])->name('posts.deleted.show');
        Route::post('/posts/deleted/{id}/restore', [AdminPostController::class, 'restore'])->name('posts.restore');
        Route::delete('/posts/deleted/{id}/force', [AdminPostController::class, 'forceDelete'])->name('posts.forceDelete');
        Route::resource('posts', AdminPostController::class);

        // Categories
        Route::get('/categories/deleted/list', [AdminCategoryController::class, 'deleted'])->name('categories.deleted');
        Route::get('/categories/deleted/{id}', [AdminCategoryController::class, 'showDeleted'])->name('categories.deleted.show');
        Route::post('/categories/deleted/{id}/restore', [AdminCategoryController::class, 'restore'])->name('categories.restore');
        Route::delete('/categories/deleted/{id}/force', [AdminCategoryController::class, 'forceDelete'])->name('categories.forceDelete');
        Route::resource('categories', AdminCategoryController::class);

        // Messages
        Route::get('/messages/deleted/list', [AdminMessageController::class, 'deleted'])->name('messages.deleted');
        Route::get('/messages/deleted/{id}', [AdminMessageController::class, 'showDeleted'])->name('messages.deleted.show');
        Route::post('/messages/deleted/{id}/restore', [AdminMessageController::class, 'restore'])->name('messages.restore');
        Route::delete('/messages/deleted/{id}/force', [AdminMessageController::class, 'forceDelete'])->name('messages.forceDelete');

        Route::get('/messages', [AdminMessageController::class, 'index'])->name('messages.index');
        Route::get('/messages/{message}', [AdminMessageController::class, 'show'])->name('messages.show');
        Route::delete('/messages/{message}', [AdminMessageController::class, 'destroy'])->name('messages.destroy');
    });

require __DIR__.'/auth.php';
