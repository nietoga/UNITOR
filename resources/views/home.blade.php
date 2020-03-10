@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{__('messages.main')}}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <p>{{ __('messages.welcome') }}</p>
                    <a class="btn btn-primary" href="{{ route('period.index') }}">{{__('messages.periods')}}</a>
                    @if(Auth::user()->isAdmin())
                    <a class="btn btn-primary" href="{{ route('admin.index') }}">{{__('messages.panel')}}</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection