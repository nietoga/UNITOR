@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center h1">{{ $data['period']->getName() }}</div>
                {{ Breadcrumbs::render('period', $data['period']) }}
                <div class="card-body text-center">
                    <ul class="list">
                        @foreach ($data['period']->courses as $course)
                            <li class="row justify-content-md-center">
                                <div class="list_item m-1">
                                    <a class="col list-link" href="{{ route('course.show', $course->getId()) }}">
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
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    <form action="{{ route('course.new') }}" method="get">
                        <input type="hidden" name="period_id" value="{{ $data['period']->getId() }}">
                        <button type="submit" class="btn btn-success">{{ __('messages.new-course') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection