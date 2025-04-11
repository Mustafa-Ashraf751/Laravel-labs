<?php

use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Make route to return token to put it in postman
Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);
    if (!Auth::attempt($credentials)) {
        return response()->json([
            'message' => 'Invalid login credentials'
        ], 401);
    }

    $user = Auth::user();

    $token = $user->createToken('postman-token')->plainTextToken;

    return response()->json([
        'token' => $token,
        'user' => $user->name
    ]);
});


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/posts', function () {

        $posts = Post::with('user')->paginate(10);

        return PostResource::collection($posts);
    });

    Route::get('/posts/{id}', function ($id) {
        $post = Post::with('user')->findOrFail($id);

        return new PostResource($post);
    });

    Route::post('/posts', function (PostRequest $request) {

        $post =  Post::create($request->validated());

        return response()->json($post, 201);
    });
});
