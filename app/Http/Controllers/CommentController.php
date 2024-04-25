<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
class CommentController extends Controller
{ 

public function store(Request $request, $postId)
{ 
    $request->validate([
        'body' => 'required|max:255',
    ]);
    $post = Post::find($postId);

    if (!$post) {
        
        return redirect("/posts")->with('error', 'Post not found');
    }

    $comment = new Comment;
    $comment->body = $request->body;
    $comment->user_id = Auth::id();
    $comment->post_id = $post->id;
    $comment->save();

    return redirect("/posts/{$post->id}")->with('success', 'Comment submitted successfully!');
}
}

