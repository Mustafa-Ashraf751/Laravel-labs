<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CommentController;
use App\Http\Resources\PostResource;


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Public routes for posts
    Route::resource('posts', postsController::class);

    Route::get('posts/{postId}/delete', [postsController::class, 'delete'])->name('posts.delete');

    // Comment routes
    Route::resource('comments', CommentController::class);

    // Additional custom routes for comments
    Route::patch('/comments/{comment}/restore', [CommentController::class, 'restore'])->name('comments.restore');
    Route::delete('/comments/{comment}/force-delete', [CommentController::class, 'forceDelete'])->name('comments.force-delete');

    Route::get('/posts/{post}/data', function (\App\Models\Post $post) {
        return new PostResource($post);
    })->name('posts.data');
});


require __DIR__ . '/auth.php';
