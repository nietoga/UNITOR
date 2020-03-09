@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $period->getName() }}</div>
                <div class="card-body">
                    <ul>
                        @foreach ($period->courses as $course)
                            <li>
                                <a href="{{ route('course.show', $course->getId()) }}">
                                    {{ $course->getName() }}
                                </a>
                            </li>
                        @endforeach
                    </ul>

                    <form action="{{ route('course.new') }}" method="get">
                        <input type="hidden" name="period_id" value="{{ $period->getId() }}">
                        <button type="submit" class="btn btn-primary">New Course</button>
                    </form>

                    <form action="{{ route('period.delete', $period->getId()) }}" method="post">
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