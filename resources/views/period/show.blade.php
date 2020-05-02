@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{ Breadcrumbs::render('period', $data['period']) }}

            <div class="card">
                <div class="card-header">{{ __('messages.period') . ': ' . $data['period']->getName() }}</div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($data['period']->courses as $course)
                        <div>
                            <li class="list-group-item red">
                                <a href="{{ route('course.show', ['id' => $course->getId()]) }}">
                                    {{ $course->getName() }}
                                </a>

                                <div class="row justify-content-end">
                                    <form class="form-group" action="{{ route('course.edit', ['id' => $course->getId()]) }}" method="GET">
                                        <button class="btn" type="submit">
                                            <img src="https://img.icons8.com/android/24/000000/edit.png">
                                        </button>
                                    </form>

                                    <form class="form-group" action="{{ route('course.delete', ['id' => $course->getId()]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn" type="submit">
                                            <img src="https://img.icons8.com/material-outlined/24/000000/delete-forever.png">
                                        </button>
                                    </form>
                                </div>
                            </li>
                        </div>
                        @endforeach
                    </ul>

                    <div class="period-btn">
                        <form action="{{ route('course.new') }}" method="get">
                            <input type="hidden" name="period_id" value="{{ $data['period']->getId() }}">
                            <button type="submit" class="btn btn-primary">{{ __('messages.new-course') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection