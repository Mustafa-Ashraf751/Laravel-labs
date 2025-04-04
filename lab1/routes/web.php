<?php

use App\Http\Controllers\postsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [postsController::class, 'showAll'])->name('posts.home');


Route::get('/posts/create', [postsController::class, 'create'])
    ->name('posts.create');

Route::get('/posts/{post}/edit', [postsController::class, 'update'])->name('posts.update');

Route::post('/posts', [postsController::class, 'store'])->name('posts.store');

Route::put('/posts/{post}', [postsController::class, 'edit'])->name('posts.edit');

Route::get('posts/{post}', [postsController::class, 'show'])
    ->name('posts.show');
