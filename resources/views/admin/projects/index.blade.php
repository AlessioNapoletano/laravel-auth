@extends('layouts.admin')

@section('title', 'Projects')

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
                    <a href="{{ route('admin.projects.create')}}" class="btn btn-primary px-5">Create new project</a>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
            <tr>
                <td>{{ $project->id }}</td>
                <td>{{ $project->title }}</td>
                <td>{{ $project->author }}</td>
                <td>{{ $project->post_date }}</td>
                <td>
                    <a href="{{ route('admin.projects.show', $project->id) }}" class="btn btn-primary">Show</a>
                    <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-success">Edit</a>

                    <form class="d-inline delete" action="{{ route('admin.projects.destroy', $project->id)}}" method="POST">
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

    <div class="pagination">
        <span>
            {{ $projects->links() }}
        </span>
    </div>
      
</div>

@endsection

@section('script')
    @vite('resources/js/confirmDelete.js')
@endsection
