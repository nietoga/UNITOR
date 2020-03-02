@extends('layouts.forum')
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
                    <form method="POST" action="{{ route('post.save') }}">
                        @csrf
                        <input type="text" placeholder="Enter title" name="title" value="{{ old('title') }}" />
                        <textarea type="text" placeholder="Enter content" name="content" value="{{ old('content') }}"></textarea>
                        <input type="submit" value="Send" />
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection