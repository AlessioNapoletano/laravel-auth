@extends('layouts.admin')

@section('title', "Edit '$post->title' Post")

@section('content')
    <div class="container my-5">
        @include('admin.posts.partials.error')
        @include('admin.posts.partials.form', ['method' => 'PUT', 'action' => 'admin.posts.update' , 'parameter' => 'post->id', 'buttonClass' => 'success', 'buttonText' => 'Edit Post'])
    </div>
@endsection
