@extends('layouts.forum')
@section("title", $data["title"])
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Posts list </div>
                <div class="card-body">
                    <div class="row p-5">
                        <div class="col-md-12">
                            <ul id="errors">
                                @foreach($data["posts"] as $post)
                                <span class="bold-id"> {{ $post->getId() }} </span> -
                                <a class="" href="{{ route('post.show', ['id' => $post->getId()] ) }}">
                                    {{ $post->getTitle() }}
                                </a>
                                <p>{{ $post->getContent() }}</p>
                                
                                <br />
                                <br />
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection