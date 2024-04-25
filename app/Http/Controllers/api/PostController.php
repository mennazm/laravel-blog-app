<?php

namespace App\Http\Controllers\api;
use App\Models\Post;
use App\Http\Requests\Postrequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;

class PostController extends Controller
{
    function index(){
        $posts = Post::with('user')->paginate(5);
        
         return PostResource::collection($posts);
     }


     function store(Postrequest $request){
        //return "added successfully";
        $post = new Post; 
        $post ->title = $request -> title;
        $post ->body = $request ->  body;
        $post -> user_id = $request -> user_id;
        $post->save();
        
          return "Post created successfully!";
 }

 function show($id){
    $post= Post::find($id);

    return $post; 
 }
 
 function update($id , Postrequest $request){
    $post= Post::find($id);
    $post->title = $request->title;
    $post->body = $request->body;
    $post->user_id = $request->user_id; 
   

  
    $post -> save();
    return 'Post updated successfully!';
}

function destroy($id){
    $post = Post::findOrFail($id);
    $post->delete();
    return "post deleted successfully";
}
}
