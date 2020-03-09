@extends('layouts.forum')
@section("title", $data["title"])
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit post</div>
                <div class="card-body">
                    @if($errors->any())
                    <ul id="errors">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif
                    <form class="form-group green-border-focus form-post" action="{{ route('comment.update', [ 'id' => $data['comment']['id'] ]) }}" method="POST">
                        @csrf
                        {{ method_field('PATCH') }}
                        <textarea class="form-control" rows="4" type="text" name="description">{{ $data['comment']->getDescription() }}</textarea>
                        <input class="btn btn-success" type="submit" value="Update" />
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection