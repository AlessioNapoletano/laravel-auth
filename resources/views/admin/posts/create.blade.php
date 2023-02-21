@extends('layouts.admin')

@section('content')
    <div class="container my-5">
        <form action="{{ route('admin.posts.store') }}" method="POST">
            @csrf
            
            <h4 class="mb-3 fw-bold">
                {{ Auth::user()->name }}
            </h4>
            <form>
                <div class="mb-3">
                    <label for="title" class="form-label">Titolo</label>
                    <input type="text" class="form-control" id="title" name="title">
                </div>

                <div class="mb-3">
                    <label for="post_date" class="form-label">Data di pubblicazione</label>
                    <input type="date" class="form-control" id="post_date" name="post_date">
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Contenuto del post</label>
                    <textarea type="text" class="form-control" id="content" name="content">

                    </textarea>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Crea Post</button>
                </div>
            </form>
        </form>
    </div>
@endsection
