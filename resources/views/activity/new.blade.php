@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('messages.new-activity') }}</div>
                <div class="card-body">
                    <form action="{{ route('activity.save') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="course_id" value="{{ $data['course_id'] }}">
                            <label for="name">{{ __('messages.name') }}</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('messages.enter-name') }}" value="{{ old('name') }}">
                            <label for="percentage">{{ __('messages.percentage') }}</label>
                            <input type="number" min="0" max="100" step="0.01" class="form-control" id="percentage" name="percentage" placeholder="{{ __('messages.enter-percentage') }}" value="{{ old('percentage') }}">
                            <label for="grade">{{ __('messages.grade') }}</label>
                            <input type="number" min="0" max="5" step="0.01" class="form-control" id="grade" name="grade" placeholder="{{ __('messages.enter-grade') }}" value="{{ old('grade') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('messages.create') }}</button>
                    </form>    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection