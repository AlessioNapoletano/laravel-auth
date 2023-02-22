@extends('layouts.admin')

@section('title', 'Post trashed')

@section('content')

<section class="trashed-post">
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#id</th>
                    <th scope="col">Title</th>
                    <th scope="col">Author</th>
                    <th scope="col">Post Date</th>
                    <th scope="col">Delete at</th>
                    <th scope="col">
                        <form action="{{ route('admin.restore-all') }}" method="POST">
                        @csrf
                            <button class="btn btn-primary">Ripristina Tutti i Post</button>
                        </form>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($postsTrashed as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->author }}</td>
                    <td>{{ $post->post_date }}</td>
                    <td>{{ $post->deleted_at }}</td>
                    <td>
                        <form class="d-inline" action="{{ route('admin.restore', $post->id)}}" method="POST">
                            @csrf
                            <button class="btn btn-primary">Ripristina</button>
                        </form> 
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>
    </div>
</section>
@endsection