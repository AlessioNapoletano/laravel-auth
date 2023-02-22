@extends('layouts.admin')

@section('title', 'dashboard admin')

@section('content')
<div class="container my-4">
    <!--Print message-->
    @if (session('message'))
        <div class="alert alert-{{session('message-class')}} mb-3">
            {{ session('message') }}
        </div>
    @endif
    
    @if (session('alert-message'))
        <div id="popup_message" class="d-none" data-type="{{ session('alert-type') }}" data-message="{{ session('alert-message') }}"></div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#id</th>
                <th scope="col">Title</th>
                <th scope="col">Author</th>
                <th scope="col">Post Date</th>
                <th scope="col">
                    <a href="{{ route('admin.posts.create') }}" class="btn btn-primary px-5">Create new post</a>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->author }}</td>
                <td>{{ $post->post_date }}</td>
                <td>
                    <a href="{{ route('admin.posts.show', $post->id) }}" class="btn btn-primary">Show</a>
                    <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-success">Edit</a>

                    <form class="d-inline delete" action="{{ route('admin.posts.destroy', $post->id)}}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button class="btn btn-danger">
                        Delete
                    </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
      </table>
</div>
@endsection

@section('script')
    @vite('resources/js/confirmDelete.js')
@endsection
