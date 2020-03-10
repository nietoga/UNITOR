@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">New Activity</div>
                <div class="card-body">
                    <form action="{{ route('activity.save') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="course_id" value="{{ $course_id }}">
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