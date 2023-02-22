@extends('layouts.admin')

@section('title', 'Project trashed')

@section('content')

<section class="trashed-projects">
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
                        <form action="{{ route('admin.restore-all-projects') }}" method="POST">
                        @csrf
                            <button class="btn btn-primary">Ripristina Tutti i Post</button>
                        </form>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projectTrashed as $project)
                <tr>
                    <td>{{ $project->id }}</td>
                    <td>{{ $project->title }}</td>
                    <td>{{ $project->author }}</td>
                    <td>{{ $project->post_date }}</td>
                    <td>{{ $project->deleted_at }}</td>
                    <td>
                        <form class="d-inline" action="{{ route('admin.restore-project', $project->id)}}" method="POST">
                            @csrf
                            <button class="btn btn-primary">Restore</button>
                        </form> 

                        <form class="d-inline delete" action="{{ route('admin.force-delete-project', $project->id)}}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger">Delete</button>
                        </form> 
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>
    </div>
</section>
@endsection

@section('script')
    @vite('resources/js/confirmDelete.js')
@endsection