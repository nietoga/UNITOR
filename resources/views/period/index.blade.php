@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                {{ Breadcrumbs::render('dashboard') }}
                <div class="card-body">
                    @foreach ($data['periods'] as $period)
                        <a href="{{ route('period.show', ['id' => $period->getId()]) }}">
                            {{ $period->getName() }}
                        </a>

                        <div class="row justify-content-end">
                            <form class="form-group" action="{{ route('period.edit', ['id' => $period->getId()]) }}" method="GET">
                                <button class="btn" type="submit">
                                    <img src="https://img.icons8.com/android/24/000000/edit.png">
                                </button>
                            </form>

                            <form class="form-group" action="{{ route('period.delete', ['id' => $period->getId()]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn" type="submit">
                                    <img src="https://img.icons8.com/material-outlined/24/000000/delete-forever.png">
                                </button>
                            </form>
                        </div>
                    @endforeach

                    <form action="{{ route('period.new') }}" method="get">
                        <button type="submit" class="btn btn-primary">{{ __('messages.new-period') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection