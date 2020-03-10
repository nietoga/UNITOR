@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $course->getName() }}</div>
                <div class="card-body">
                <ul>
                        @foreach ($course->activities as $activity)
                            <li>
                                <a href="{{ route('activity.show', $activity->getId()) }}">
                                    {{ $activity->getName() }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <form action="{{ route('activity.new') }}" method="get">
                        <input type="hidden" name="course_id" value="{{ $course->getId() }}">
                        <button type="submit" class="btn btn-primary">New Activity</button>
                    </form>
                    <form action="{{ route('course.delete', $course->getId()) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection