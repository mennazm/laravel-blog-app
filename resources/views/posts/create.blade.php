@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Create a New Post</h1>
        
        <form action="/posts" method="POST" enctype="multipart/form-data">
            @csrf 
            
            <div class="mb-3">
                <label for="title" class="form-label">Title:</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>
            
            <div class="mb-3">
                <label for="body" class="form-label">Body:</label>
                <textarea class="form-control" id="body" name="body"></textarea>
            </div>
            
            

            <div class="mb-3">
                <label for="image" class="form-label">Image:</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            
            
            <button type="submit" class="btn btn-primary">Create Post</button>
        </form>
    </div>



    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</body>
</html>
@endsection