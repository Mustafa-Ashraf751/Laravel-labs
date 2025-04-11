<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;


class CommentController extends Controller
{

    public function store(Request $request, $postId)
    {
        $request->validate([
            'content' => 'required|min:3|max:1000'
        ]);

        $post = Post::findOrFail($postId);
        $user = $post->user;

        $comment = new Comment();
        $comment->content = $request->content;
        $comment->user_id = $user->id;

        $post->comments()->save($comment);

        return redirect()->route('posts.show', $post->id)->with('success', 'comment added successfully');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|min:3|max:1000'
        ]);

        $comment = Comment::findOrFail($id);
        $comment->content = $request->content;
        $comment->save();

        //Get the post of the updated comment
        $commentable = $comment->commentable;

        return redirect()->route('posts.show', $commentable->id)->with('success', 'comment updated successfully');
    }

    public function destroy($id)
    {

        $comment = Comment::findOrFail($id);
        //Get the post id to redirect
        $commentable = $comment->commentable;
        $comment->delete();


        return redirect()->route('posts.show', $commentable->id)->with('success', 'Comment deleted successfully');
    }


    public function restore($id)
    {
        $comment = Comment::onlyTrashed()->findOrFail($id);
        $comment->restore();

        $commentable = $comment->commentable;

        return redirect()->route('posts.show', $commentable->id)->with('success', 'Comment restored successfully');
    }


    public function forceDelete($id)
    {
        $comment = Comment::withTrashed()->findOrFail($id);
        $commentable = $comment->commentable;
        $comment->forceDelete();

        return redirect()->route('posts.show', $commentable->id)->with('success', 'Comment permanently deleted');
    }
}
