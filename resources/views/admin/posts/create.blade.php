@extends('layouts.admin')

@section('title', 'Create new Post')

@section('content')
    <div class="container my-5">
        @include('admin.posts.partials.error')
        @include('admin.posts.partials.form', ['method' => 'POST', 'action' => 'admin.posts.store', 'parameter' => '', 'buttonClass' => 'primary', 'buttonText' => 'Crea Post'])
    </div>
@endsection
