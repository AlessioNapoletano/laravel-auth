@extends('layouts.admin')

@section('title', 'Portfolio')

@section('content')

<div class="container my-5">
    <div class="row">
        @foreach ($projects as $project)
            <div class="col-6">
                <div class="card mb-4 d-flex align-items-stretch">
                    <div class="card-header d-flex justify-content-between">
                        <span class="fw-bold">
                            {{ $project->author }}
                        </span>
                        <span>
                            {{ $project->post_date }}
                        </span>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title fw-bold text-center">{{ $project->title }}</h5>
                        <p class="card-text">{{ $project->content }}</p>
                    </div>
                </div>
            </div>  
        @endforeach
    </div>

    <div class="pagination">
        <span>
            {{ $projects->links() }}
        </span>
    </div>
</div>

@endsection