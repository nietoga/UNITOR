@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">New Course</div>
                <div class="card-body">
                    <form action="{{ route('course.save') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="period_id" value="{{ $period_id }}">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection