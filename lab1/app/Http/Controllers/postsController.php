<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class postsController extends Controller
{

    private static $POSTS = [
        ['id' => 1, 'email' => 'ahmed@gmail.com', 'description' => 'Just place holder for description', 'title' => 'Welcome to laravel', 'posted_by' => 'Ahmed', 'created_at' => '2024-11-10 5:00:00'],
        ['id' => 2, 'title' => 'Second Post', 'email' => 'moahmed@gmail.com', 'description' => 'Just place holder for description', 'posted_by' => 'Mohamed', 'created_at' => '2024-11-10 6:00:00'],
        ['id' => 3, 'title' => 'Third Post', 'email' => 'ali@gmail.com', 'description' => 'Just place holder for description', 'posted_by' => 'Ali', 'created_at' => '2025-1-10 9:00:00'],
        ['id' => 4, 'title' => 'Learning laravel', 'email' => 'mustafa@gmail.com', 'description' => 'Just place holder for description', 'posted_by' => 'Mustafa', 'created_at' => '2025-3-15 10:00:00'],
    ];

    private static $USERS = [
        ['name' => 'Ahmed', 'email' => 'ahmed@gmail.com'],
        ['name' => 'Mohamed', 'email' => 'moahmed@gmail.com'],
        ['name' => 'Ali', 'email' => 'ali@gmail.com'],
        ['name' => 'Mustafa', 'email' => 'mustafa@gmail.com'],
    ];


    public function showAll()
    {
        return view('posts.home', [
            'posts' => $this->getPosts(),
        ]);
    }

    public function show($postId)
    {
        $post = collect($this->getPosts())->firstWhere('id', $postId);

        return view('posts.show', [
            'post' => $post
        ]);
    }

    public function create()
    {
        return view('posts.create', ['users' => self::$USERS]);
    }

    private function getPosts()
    {
        if (!session()->has('posts')) {
            session(['posts' => self::$POSTS]);
        }
        return session('posts');
    }

    private function savePosts($posts)
    {
        session(['posts' => $posts]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required',
                'description' => 'required',
                'posted_by' => 'required'
            ]
        );

        $user = collect(self::$USERS)->firstWhere('name', $request->posted_by);

        $email = $user ? $user['email'] : '';

        $posts = $this->getPosts();

        $nextId = count($posts) + 1;

        $newPost = [
            'id' => $nextId,
            'title' => $request->title,
            'description' => $request->description,
            'posted_by' => $request->posted_by,
            'email' => $email,
            'created_at' => date('Y-m-d H:i:s')
        ];


        $posts[] = $newPost;
        $this->savePosts($posts);

        return to_route('posts.home');
    }

    public function update($postId)
    {

        $post = collect($this->getPosts())->firstWhere('id', $postId);

        if (!$post) {
            return to_route('posts.home');
        }

        return view('posts.update', [
            'post' => $post,
            'users' => self::$USERS
        ]);
    }

    public function edit(Request $request, $postId)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'posted_by' => 'required'
        ]);

        $posts = $this->getPosts();

        //Find the index of the post to update it
        $index = array_search($postId, array_column($posts, 'id'));

        if ($index === false) {
            return to_route('posts.home');
        }

        $user = collect(self::$USERS)->firstWhere('name', $request->posted_by);
        $email = $user ? $user['email'] : '';

        $posts[$index]['title'] = $request->title;
        $posts[$index]['description'] = $request->description;
        $posts[$index]['posted_by'] = $request->posted_by;
        $posts[$index]['email'] = $email;

        $this->savePosts($posts);

        return to_route('posts.home')->with('success', 'Post updated successfully');
    }
}
