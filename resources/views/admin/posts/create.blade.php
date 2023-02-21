@extends('layouts.admin')

@section('content')
    <div class="container my-5">
        @include('admin.posts.partials.form', ['method' => 'POST', 'action' => 'admin.posts.store'])
    </div>
@endsection
