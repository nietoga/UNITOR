@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Periods</div>

                <div class="card-body">
                    <ul>
                        @foreach ($periods as $period)
                            <li>
                                <a href="{{ route('period.show', $period->getId()) }}">
                                    {{ $period->getName() }}
                                </a>
                            </li>
                        @endforeach
                    </ul>

                    <form action="{{ route('period.new') }}" method="get">
                        <button type="submit" class="btn btn-primary">New Period</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection