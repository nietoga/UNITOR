@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        {{ Breadcrumbs::render('admin') }}
            <div class="card">
                <div class="card-header">{{ __('messages.admin_title') }}</div>
                <div class="card-body">
                    <a class="btn btn-danger" href="{{ route('admin.comments') }}">{{ __('messages.comments')}}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection