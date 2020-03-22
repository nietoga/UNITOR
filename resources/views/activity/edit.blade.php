@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('messages.update-activity') }}</div>
                <div class="card-body">
                    <form action="{{ route('activity.update', $data['activity']->getId()) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <input type="hidden" name="course_id" value="{{ $data['activity']->course->getId() }}">
                            <label for="name">{{ __('messages.name') }}</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('messages.enter-name') }}" value="{{ $data['activity']->getName() }}">
                            <label for="percentage">{{ __('messages.percentage') }}</label>
                            <input type="number" min="0" max="100" step="0.01" class="form-control" id="percentage" name="percentage" placeholder="{{ __('messages.enter-percentage') }}" value="{{ $data['activity']->getPercentage() }}">
                            <label for="grade">{{ __('messages.grade') }}</label>
                            <input type="number" min="0" max="5" step="0.01" class="form-control" id="grade" name="grade" placeholder="{{ __('messages.enter-grade') }}" value="{{ $data['activity']->getGrade() }}">
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('messages.update') }}</button>
                    </form>    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection