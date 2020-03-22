@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $data['period']->getName() }}</div>
                {{ Breadcrumbs::render('period', $data['period']) }}
                <div class="card-body">
                    <ul>
                        @foreach ($data['period']->courses as $course)
                            <li>
                                <a href="{{ route('course.show', $course->getId()) }}">
                                    {{ $course->getName() }}
                                </a>

                                <form action="{{ route('course.edit', $course->getId()) }}" method="get">
                                    <button type="submit" class="btn btn-primary">{{ __('messages.edit') }}</button>
                                </form>

                                <form action="{{ route('course.delete', $course->getId()) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">{{ __('messages.delete') }}</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>

                    <form action="{{ route('course.new') }}" method="get">
                        <input type="hidden" name="period_id" value="{{ $data['period']->getId() }}">
                        <button type="submit" class="btn btn-primary">{{ __('messages.new-course') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection