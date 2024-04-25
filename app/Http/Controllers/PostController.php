<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\Postrequest;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    function index(){
       //$posts=Post::all();
       $posts = Post::simplePaginate(5);
        return view('posts.index',["posts" => $posts]);
    }
    function create(){
        

        return view("posts.create");
    }


    function store(Postrequest $request){
           //return "added successfully";
           $post = new Post; 
           $post ->title = $request -> title;
           $post ->body = $request ->  body;
           
           $post -> user_id = Auth::id();
           if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts_images', 'public');
            $post->image = $imagePath;

        }
        
           $post -> save();
           return redirect()->route('posts.show', $post->id)->with('success', 'Post created successfully!');
    }

    function show($id){
       $post= Post::find($id);

        return view("posts.show", ["post"=>$post]);
    }


    function edit($id){
        $post= Post::find($id); 
        return view("posts.edit", ["post"=>$post]);
    }

    function update($id , Postrequest $request){
        $post= Post::find($id);
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = Auth::id(); 
       
    
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts_images', 'public');
            $post->image = $imagePath;
        }
        $post -> save();
        return redirect()->route('posts.show', $post->id)->with('success', 'Post updated successfully!');
    }


    function destroy($id){
        $post = Post::findOrFail($id);

        if ($post->image) {
            Storage::delete($post->image);
        }

        $post->delete();
        return redirect()->route('posts.index');
    }
}
