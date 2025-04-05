<?php

use App\Http\Controllers\postsController;
use Illuminate\Support\Facades\Route;

Route::resource('posts', postsController::class);

Route::get('posts/{postId}/delete', [postsController::class, 'delete'])->name('posts.delete');
