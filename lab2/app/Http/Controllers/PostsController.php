<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

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



    public function store(PostRequest $request)
    {
        $validatedRequest =  $request->validated();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('post-images', 'public');
            $validatedRequest['image'] = $imagePath;
        }


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

    public function update(PostRequest $request, $postId)
    {
        $validatedRequest = $request->validated();

        $post = Post::findOrFail($postId);

        if (!$post) {
            return to_route('posts.index');
        }
        //dd("Storage::disk('public')->exists($post->image)");
        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $imagePath = $request->file('image')->store('post-images', 'public');
            $validatedRequest['image'] = $imagePath;
        }



        $post->update($validatedRequest);

        return to_route('posts.index')->with('success', 'Post updated successfully');
    }

    public function delete($postId)
    {
        $post = Post::with('user')->findOrFail($postId);

        $post->formatted_date = $post->created_at->format('l jS \\of F Y h:i:s A');

        if ($post->image && Storage::disk('public')->exists($post->image)) {
            Storage::disk('public')->delete($post->image);
        }

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
