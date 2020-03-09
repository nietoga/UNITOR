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
                    <div class="mic-info">
                        <p>By: <b>{{ $data["post"]->user == Auth::user() ? "Me":$data["post"]->user->getName() }}</b> on {{ $data["post"]->created_at->format("d/m/Y") }}</p>
                    </div>
                    <p>{{ $data["post"]["content"] }}</p>
                    @if($data["allowed_ops"])
                    <div class="form-inline">
                        <form class="form-group" action="{{ route('post.delete', [ 'id' => $data['post']['id'] ]) }}" method="POST">
                            @csrf
                            {{ method_field('DELETE') }}
                            <input class="btn btn-danger" type="submit" value="Delete" />
                        </form>

                        <form class="form-group" action="{{ route('post.edit', [ 'id' => $data['post']['id'] ]) }}" method="POST">
                            @csrf
                            <input class="btn btn-warning" type="submit" value="Edit" />
                        </form>
                    </div>
                    @endif
                </div>
            </div>
            <div class="card">
                <div class="card-header">Comments</div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($data["post"]["comments"] as $comment)
                        <div class="">
                            <li class="list-group-item red">
                                <div class="row">
                                    <div class="col-xs-9 col-md-10">
                                        <div class="mic-info">
                                            By: <b> {{ $comment->user == Auth::user() ? "Me":$comment->user->getName() }} </b> on {{ $comment->updated_at->format("d/m/Y") }}
                                        </div>
                                        <div class="comment-text">
                                            {{ $comment->getDescription() }}
                                        </div>
                                    </div>
                                    <div class="col-xs-2 col-md-2 btns-box">
                                        @if($comment->user == Auth::user() )
                                        <div class="action form-inline">
                                            <form class="form-group comments-btns" action="{{ route('comment.delete', [ 'id' => $comment->getId() ]) }}" method="POST">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                                <button class="btn" type="submit">
                                                    <img src="https://img.icons8.com/material-outlined/24/000000/delete-forever.png">
                                                </button>
                                            </form>
                                            <form class="form-group comments-btns" action="{{ route('comment.edit', [ 'id' => $comment->getId() ]) }}" method="POST">
                                                @csrf
                                                <button class="btn" type="submit">
                                                    <img src="https://img.icons8.com/android/24/000000/edit.png">
                                                </button>
                                            </form>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        </div>
                    </ul>
                    @endforeach

                    <div class="add-comment">
                        @if($errors->any())
                        <ul id="errors">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        @endif
                        <form class="form-group" action="{{ route('comment.save') }}" method="POST">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $data['post']->getId() }}">
                            <textarea class="form-control" rows="4" type="text" placeholder="Add your answer" name="description"></textarea>
                            <input class="btn btn-secondary" type="submit" value="Comment" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection