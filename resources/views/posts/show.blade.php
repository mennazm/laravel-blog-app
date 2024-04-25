@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Show Post</title>
</head>
<body>
    <div class="container">
        <h1>Show Post</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $post['title'] }}</h5>
                <p class="card-text">{{ $post['body'] }}</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">postID: {{ $post['id'] }}</li>
                <li class="list-group-item">Posted By: {{ $post->user->name }}</li>
                @if($post->image)
                    <li class="list-group-item">
                        
                        <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid" alt="Post Image">
                    </li>
                @endif
            </ul>
            <a href="/posts/{{ $post['id'] }}/edit" class="btn btn-success mt-3">Edit Post</a>
        </div>
    
                @foreach ($post->comments as $comment)
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $comment->user->name }}</h5>
                    <p class="card-text">{{ $comment->body }}</p>
                </div>
            </div>
            @endforeach

       

        <button type="button" class="btn btn-primary mt-5" data-bs-toggle="modal" data-bs-target="#commentModal">
            Add Comment
        </button>
    </div>


 
<div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="commentModalLabel">Add Comment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <form action="/posts/{{ $post->id }}/comments" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="body" class="form-label">Comment:</label>
                        <textarea class="form-control" id="body" name="body" rows="3"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit Comment</button>
                </form>
               
            </div>
        </div>
    </div>
</div>

</body>
</html>
@endsection