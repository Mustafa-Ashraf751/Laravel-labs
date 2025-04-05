<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\User;

class postsController extends Controller
{

    public function index()
    {

        $posts = Post::with('user')->paginate(10);

        return view('posts.home', [
            'posts' => $posts,
        ]);
    }

    public function show($postId)
    {

        $post = Post::with('user')->findOrFail($postId);
        $post->formatted_date = $post->created_at->format('l jS \\of F Y h:i:s A');

        $user = User::findOrFail($post->user_id);

        return view('posts.show', [
            'post' => $post
        ]);
    }

    public function create()
    {
        return view('posts.create', ['users' => User::all()]);
    }



    public function store(Request $request)
    {
        $validatedRequest =  $request->validate(
            [
                'title' => 'required',
                'description' => 'required',
                'user_id' => 'required'
            ]
        );


        Post::create($validatedRequest);



        return to_route('posts.index');
    }

    public function edit($postId)
    {

        $post = Post::findOrFail($postId);

        if (!$post) {
            return to_route('posts.index');
        }

        return view('posts.update', [
            'post' => $post,
            'users' => User::all()
        ]);
    }

    public function update(Request $request, $postId)
    {
        $validatedRequest = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'user_id' => 'required'
        ]);

        $post = Post::findOrFail($postId);

        if (!$post) {
            return to_route('posts.index');
        }

        $post->update($validatedRequest);

        return to_route('posts.index')->with('success', 'Post updated successfully');
    }

    public function delete($postId)
    {
        $post = Post::with('user')->findOrFail($postId);

        $post->formatted_date = $post->created_at->format('l jS \\of F Y h:i:s A');

        return view('posts.delete', [
            'post' => $post
        ]);
    }

    public function destroy(Post $post)
    {


        $post->delete();

        return to_route('posts.index')->with('success', 'Post deleted successfully');
    }
}
