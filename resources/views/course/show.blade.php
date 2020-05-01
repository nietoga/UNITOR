@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{ Breadcrumbs::render('course', $data['course']) }}

            <div class="card">
                <div class="card-header">{{ __('messages.course') . ': ' . $data['course']->getName() }}</div>
                <div class="card-body">
                    @foreach ($data['course']->activities as $activity)
                        <a href="{{ route('activity.show', ['id' => $activity->getId()]) }}">
                            {{ $activity->getName() }}
                        </a>

                        <div class="row justify-content-end">
                            <form class="form-group" action="{{ route('activity.edit', ['id' => $activity->getId()]) }}" method="GET">
                                <button class="btn" type="submit">
                                    <img src="https://img.icons8.com/android/24/000000/edit.png">
                                </button>
                            </form>

                            <form class="form-group" action="{{ route('activity.delete', ['id' => $activity->getId()]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn" type="submit">
                                    <img src="https://img.icons8.com/material-outlined/24/000000/delete-forever.png">
                                </button>
                            </form>
                        </div>
                    @endforeach

                    @if (count($data['course']->activities) > 0)
                        <h5>{{ __('messages.you-need', ['needed' => $data['needed'], 'remaining' => $data['remaining']]) }}</h5>
                    @else
                        <h5>{{ __('messages.empty-course') }}</h5>
                    @endif

                    <form action="{{ route('activity.new') }}" method="get">
                        <input type="hidden" name="course_id" value="{{ $data['course']->getId() }}">
                        <button type="submit" class="btn btn-primary">{{ __('messages.new-activity') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection