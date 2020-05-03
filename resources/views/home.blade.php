@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 text-center">
            <div id="main-text" class="card-header">{{__('messages.main')}}</div>
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            <p id="message_welcome">{{ __('messages.welcome') }}</p>
            <a class="btn btn-primary btn-lg m-3" href="{{ route('period.index') }}">{{__('messages.periods')}}</a>
            @if(Auth::user()->isAdmin())
            <a class="btn btn-primary btn-lg" href="{{ route('admin.index') }}">{{__('messages.panel')}}</a>
            @endif
        </div>
    </div>
</div>
@endsection