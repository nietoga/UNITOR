@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{__('messages.periods')}}</div>

                <div class="card-body">
                    <ul>
                        @foreach ($data['periods'] as $period)
                            <li>
                                <a href="{{ route('period.show', $period->getId()) }}">
                                    {{ $period->getName() }}
                                </a>

                                <form action="{{ route('period.edit', $period->getId()) }}" method="get">
                                    <button type="submit" class="btn btn-primary">{{ __('messages.edit') }}</button>
                                </form>

                                <form action="{{ route('period.delete', $period->getId()) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">{{ __('messages.delete') }}</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>

                    <form action="{{ route('period.new') }}" method="get">
                        <button type="submit" class="btn btn-primary">{{__('messages.new-period')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection