@extends('layouts.admin')

@section('title', "Edit '$project->title' Project")

@section('content')
    <div class="container my-5">
        @include('admin.projects.partials.error')
        @include('admin.projects.partials.form', ['method' => 'PUT', 'action' => 'admin.projects.update' , 'parameter' => 'projects->id', 'buttonClass' => 'success', 'buttonText' => 'Edit Project'])
    </div>
@endsection
