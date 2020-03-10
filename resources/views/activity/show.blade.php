@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $activity->getName() }}</div>
                <div class="card-body">
                    <ul>
                        <li>
                            {{ $activity->getPercentage() }}%
                        </li>
                        <li>
                            {{ $activity->getGrade() }}
                        </li>
                    </ul>
                    <form action="{{ route('activity.delete', $activity->getId()) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">{{ __('messages.delete') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection