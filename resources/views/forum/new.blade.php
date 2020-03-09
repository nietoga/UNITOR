@extends('layouts.app')
@section("title", $data["title"])
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('util.message')
            <div class="card">
                <div class="card-header">Create post</div>
                <div class="card-body">
                    @if($errors->any())
                    <ul id="errors">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif
                    <form class="form-group green-border-focus form-post" method="POST" action="{{ route('post.save') }}">
                        @csrf
                        <input class="form-control" type="text" placeholder="Enter title" name="title" value="{{ old('title') }}" />
                        <textarea class="form-control" rows="4" type="text" placeholder="Enter content" name="content">{{ old('content') }}</textarea>
                        <input class="btn btn-success" type="submit" value="Post" />
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection