@extends('layouts.admin')

@section('title', "Show $project->title Project")

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
                <p class="fw-bold">
                    {{ $project->author }}
                </p>
              
            </div>
            <div class="card-body">
                @if ( $project->isImageAUrl())
                    <img src="{{ $project->cover_image }}"
                @else
                    <img src="{{ asset('storage/' . $project->cover_image ) }}"
                @endif
                    alt="{{ $project->title }} image" class="img-fluid">
                    
                <h5 class="card-title text-center">
                    <span class="fw-bold">
                        {{ $project->title }}
                    </span>
                </h5>
                <p class="card-text">{{ $project->content }}</p>
                <div class="button text-center">
                    <a href="{{ route('admin.projects.edit', $project->slug) }}" class="btn btn-success">Edit</a>

                    <form action="{{ route('admin.projects.destroy', $project->slug) }}" method="POST" class="d-inline delete">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
                
            </div>
            
            <div class="card-footer text-muted text-center">
                {{ $project->post_date }}
            </div>
        </div>
    </div>
@endsection

@section('script')
    @vite('resources/js/confirmDelete.js')
@endsection
