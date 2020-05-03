@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{ Breadcrumbs::render('admin-posts') }}
            <div class="card">
                <div class="card-header">{{ __('messages.posts') }}</div>
                <div class="card-body">
                    <div class="page-description">
                        <h5>{{__('messages.admin-posts')}}</h5>
                    </div>
                    <ul class="list-group">
                        @foreach($data["posts"] as $post)
                        <div class="">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-xs-5 col-md-10">
                                        <div class="mic-info">
                                            {{__('messages.by')}}: <b> {{ $post->user == Auth::user() ? __('messages.me'):$post->user->getName() }} </b> {{__('messages.on')}} {{ $post->updated_at->format("d/m/Y") }}
                                        </div>
                                        <div>
                                            <a class="post-title" href="{{ route('post.show', ['id' => $post->getId() ]) }}">{{ $post->getTitle() }}</a>
                                        </div>
                                        <div class="post-text">
                                            {{ $post->getContent() }}
                                        </div>
                                    </div>
                                    <div class="col-xs-3 col-md-2 btns-box">
                                        <div class="action form-inline posts-btns-container">
                                            <form class="form-group posts-btns" action="{{ route('post.delete', [ 'id' => $post->getId() ]) }}" method="POST">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                                <button title="{{__('messages.delete')}}" class="btn" type="submit">
                                                    <img src="https://img.icons8.com/material-outlined/24/000000/delete-forever.png">
                                                </button>
                                            </form>
                                            <form class="form-group posts-btns" action="{{ route('post.report', [ 'id' => $post->getId() ]) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="reported" value="0">
                                                <button title="{{__('messages.acept')}}" class="btn" type="submit">
                                                    <img src="https://img.icons8.com/android/24/000000/checked-2.png">
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </div>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection