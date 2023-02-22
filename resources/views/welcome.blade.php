@extends('layouts.admin')

@section('title', 'Post')

@section('content')

<div class="container my-5">
    <div class="row">
        @foreach ($posts as $post)
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between">
                        <span class="fw-bold">
                            {{ $post->author }}
                        </span>
                        <span>
                            {{ $post->post_date }}
                        </span>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title fw-bold text-center">{{ $post->title }}</h5>
                        <p class="card-text">{{ $post->content }}</p>
                    </div>
                </div>
            </div>  
        @endforeach
    </div>
</div>

@endsection