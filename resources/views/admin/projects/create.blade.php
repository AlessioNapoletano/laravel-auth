@extends('layouts.admin')

@section('title', 'Create new Project')

@section('content')
    <div class="container my-5">
        @include('admin.projects.partials.error')
        @include('admin.projects.partials.form', ['method' => 'POST', 'action' => 'admin.projects.store', 'parameter' => '', 'buttonClass' => 'primary', 'buttonText' => 'Create project'])
    </div>
@endsection
