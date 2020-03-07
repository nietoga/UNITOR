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
            <div class="card widget">
                <div class="card-header">Comments</div>
                <div class="card-body">
                    <div class="panel-body">
                        <ul class="list-group">
                            @foreach($data["post"]["comments"] as $comment)
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-xs-10 col-md-11">
                                        <div>
                                            <div class="mic-info">
                                                By: <b> {{ $comment->user->getName() }} </b> on {{ $comment->updated_at->format("d/m/Y") }}
                                            </div>
                                        </div>
                                        <div class="comment-text">
                                            {{ $comment->getDescription() }}
                                        </div>
                                        @if($comment->user == Auth::user() )
                                        <div class="action form-inline">
                                            <form class="form-group comments-btns" action="{{ route('comment.delete', [ 'id' => $comment->getId() ]) }}" method="POST">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                                <input class="btn btn-danger btn-xs" type="submit" value="Delete" />
                                            </form>

                                            <form class="form-group comments-btns" action="{{ route('comment.update', [ 'id' => $comment->getId() ]) }}" method="POST">
                                                @csrf
                                                <input class="btn btn-primary btn-xs" type="submit" value="Edit" />
                                            </form>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        </ul>
                        @endforeach
                    </div>
                    @if($errors->any())
                    <ul id="errors">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif
                    <form class="form-group" action="{{ route('comment.save', [ 'post_id' => $data['post']['id'] ]) }}" method="POST">
                        @csrf
                        <textarea class="form-control" rows="4" type="text" placeholder="Add your answer" name="description"></textarea>
                        <input class="btn btn-secondary" type="submit" value="Comment" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection