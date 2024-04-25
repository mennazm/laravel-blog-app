@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Edit Post</h1>

        <form action="/posts/{{ $post->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Title:</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title) }}">
            </div>

            <div class="mb-3">
                <label for="body" class="form-label">Body:</label>
                <textarea class="form-control" id="body" name="body">{{ old('body', $post->body) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image:</label>
                <br>
                @if ($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" class="img-thumbnail" width="200" alt="Current Image">
                @endif
                <br>
                <input type="file" class="form-control" id="image" name="image">
            </div>

            <button type="submit" class="btn btn-primary">Update Post</button>
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

