@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{ Breadcrumbs::render('activity', $data['activity']) }}

            <div class="card">
                <div class="card-header">{{ __('messages.activity') . ': ' . $data['activity']->getName() }}</div>
                <div class="card-body">
                    <p>{{ __('messages.percentage') }}: {{ $data['activity']->getPercentage() }}%</p>
                    <p>{{ __('messages.grade') }}: {{ $data['activity']->getGrade() }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection