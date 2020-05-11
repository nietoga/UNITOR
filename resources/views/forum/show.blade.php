@extends('layouts.app')
@section("title", $data["title"])
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ $data["post"]["title"]}}
                </div>
                <div class="card-body">
                    <div class="mic-info d-flex">
                        <div class="">
                            <p>{{__('messages.by')}}: <b>{{ $data["post"]->user == Auth::user() ? __('messages.me'):$data["post"]->user->getName() }}</b> {{__('messages.on')}} {{ $data["post"]->created_at->format("d/m/Y") }}</p>
                        </div>
                        <div class="post-reported text-right ml-auto">
                            @if($data["post"]->getReported())
                            <img src="https://img.icons8.com/office/30/000000/high-importance.png" />
                            <scan>{{ __('messages.reported') }}</scan>
                            @else
                            <form class="form-group report-container" action="{{ route('post.report', [ 'id' => $data['post']->getId() ]) }}" method="POST">
                                @csrf
                                <input type="hidden" name="reported" value="1">
                                <button onclick="return confirm('Are you sure?')" class="report-btn comments-btns" type="submit">
                                    {{__('messages.report')}}
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                    <p>{{ $data["post"]["content"] }}</p>
                    @if($data["allowed_ops"])
                    <div class="form-inline">
                        <form class="form-group" action="{{ route('post.delete', [ 'id' => $data['post']['id'] ]) }}" method="POST">
                            @csrf
                            {{ method_field('DELETE') }}
                            <input onclick="return confirm('Are you sure?')" class="btn btn-danger" type="submit" value="{{__('messages.delete')}}" />
                        </form>

                        <form class="form-group" action="{{ route('post.edit', [ 'id' => $data['post']['id'] ]) }}" method="POST">
                            @csrf
                            <input class="btn btn-warning" type="submit" value="{{__('messages.edit')}}" />
                        </form>
                    </div>
                    @endif
                </div>
            </div>
            <div class="card">
                <div class="card-header">Comments</div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($data["comments"] as $comment)
                        <div class="">
                            <li class="list-group-item red">
                                <div class="row">
                                    <div class="col-xs-1 col-md-1 comment-score">
                                        @php
                                        $up_class = $down_class = "comment-score-btn";
                                        @endphp
                                        @if($comment->isUp(Auth::user()->getId()))
                                        @php
                                        $down_class = "disable"
                                        @endphp
                                        @elseif($comment->isDown(Auth::user()->getId()))
                                        @php $up_class = "disable" @endphp
                                        @endif
                                        <a class="btn comment-score-btn btn-success {{$up_class}}" href="/comment/{{$comment->getId()}}/vote-up">+</a>
                                        <br><span class="comment-score-value">{{ $comment->getScore() }}</span>
                                        <br><a class="btn comment-score-btn btn-danger {{$down_class}}" href="/comment/{{$comment->getId()}}/vote-down">-</a>
                                    </div>
                                    <div class="col-xs-5 col-md-8">
                                        <div class="mic-info">
                                            {{__('messages.by')}}: <b> {{ $comment->user == Auth::user() ? __('messages.me'):$comment->user->getName() }} </b> {{__('messages.on')}} {{ $comment->updated_at->format("d/m/Y") }}
                                        </div>
                                        <div class="comment-text">
                                            {{ $comment->getDescription() }}
                                        </div>
                                    </div>
                                    <div class="col-xs-3 col-md-3 btns-box">
                                        <div class="action form-inline comments-btns-container d-flex justify-content-end">
                                            @if($comment->user == Auth::user() )
                                            <form class="rounded form-group comments-btns" onclick="return confirm('Are you sure?')" action="{{ route('comment.delete', [ 'id' => $comment->getId() ]) }}" method="POST">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                                <button class="btn" type="submit">
                                                    <img src="https://img.icons8.com/material-outlined/24/000000/delete-forever.png">
                                                </button>
                                            </form>
                                            <form class="rounded form-group comments-btns" action="{{ route('comment.edit', [ 'id' => $comment->getId() ]) }}" method="POST">
                                                @csrf
                                                <button class="btn" type="submit">
                                                    <img src="https://img.icons8.com/android/24/000000/edit.png">
                                                </button>
                                            </form>
                                            @endif
                                            @if($comment->getReported())
                                            <div class="comment-reported text-center aling-bottom">
                                                <img src="https://img.icons8.com/office/30/000000/high-importance.png" />
                                                <scan>{{ __('messages.reported') }}</scan>
                                            </div>
                                            @else
                                            @if($data["allowed_ops"])
                                            <a class="btn form-group comments-btns" onclick="return confirm('Are you sure?')" href="{{ route( 'post.fix', ['post_id' => $data['post']->getId(), 'comment_id' => $comment->getId()] ) }}">
                                                @if($comment->getFixed())
                                                <img src="https://img.icons8.com/ios-filled/26/000000/star.png">
                                                @else
                                                <img src="https://img.icons8.com/metro/26/000000/star.png">
                                                @endif
                                            </a>
                                            @endif
                                        </div>

                                        <div class="row">
                                            <form class="form-group report-container" action="{{ route('comment.report', [ 'id' => $comment->getId() ]) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="reported" value="1">
                                                <button class="report-btn comments-btns" onclick="return confirm('Are you sure?')" type="submit">
                                                    {{__('messages.report')}}
                                                </button>
                                            </form>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        </div>
                        @endforeach
                    </ul>
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
                            <textarea class="form-control" rows="4" type="text" placeholder="{{__('messages.add-comment')}}" name="description"></textarea>
                            <input class="btn btn-secondary" type="submit" value="{{__('messages.comment-btn')}}" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection