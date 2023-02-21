@extends('layouts.admin')

@section('content')
    <div class="container my-5">
        <div class="card">
            <div class="card-header text-center">
              Featured
            </div>
            <div class="card-body">
                <h5 class="card-title text-center">
                    <span class="fw-bold">
                        {{ $post->title }}
                    </span>
                </h5>
                <p class="card-text">{{ $post->content }}</p>
                <div class="button text-center">
                    <a href="" class="btn btn-success">Edit</a>
                    <a href="" class="btn btn-danger">Delete</a>
                </div>
                
            </div>
            
            <div class="card-footer text-muted text-center">
                {{ $post->post_date }}
            </div>
        </div>
    </div>
@endsection
