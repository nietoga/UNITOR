@extends('layouts.forum')
@section("title", $data["title"])
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $data["post"]["title"]}}
                </div>
                <div class="card-body">
                    <p>By: {{ $data["post"]->user->getName() }}</p>
                    <p>{{ $data["post"]["content"] }}</p>
                    <div class="comments-session">
                        <b>Comments</b>
                        @foreach($data["post"]["comments"] as $comment)
                        <p>
                            {{ $comment->getDescription() }}
                        </p>
                        @endforeach
                    </div>
                    @if($data["delete_btn"])
                    <form action="{{ route('post.delete', [ 'id' => $data['post']['id'] ]) }}" method="POST">
                        @csrf
                        {{ method_field('DELETE') }}
                        <input class="btn btn-danger" type="submit" value="Delete" />
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection