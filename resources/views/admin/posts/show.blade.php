@extends('layouts.admin')

@section('title', "'$post->title' Post")

@section('content')
    <div class="container my-5">
        <!--Print message-->
    @if (session('message'))
        <div class="alert alert-{{session('message-class')}} mb-3">
            {{ session('message') }}
        </div>
    @endif

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
                    <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-success">Edit</a>

                    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
                
            </div>
            
            <div class="card-footer text-muted text-center">
                {{ $post->post_date }}
            </div>
        </div>
    </div>
@endsection

@section('script')
    @vite('resources/js/confirmDelete.js')
@endsection

