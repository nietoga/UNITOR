@extends('layouts.app')
@section("title", "Image Storage - DI")
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('util.message')
            <div class="card">
                <div class="card-header">Upload image</div>
                <div class="card-body">
                    <div class="profile-photo-container text-center">
                        <img class="rounded profile-photo" src="{{ URL('https://unitor-static-files.s3.amazonaws.com/profile-photos/'.$data['user']->getAvatar()) }}" />
                    </div>
                    <form action="{{ route('user.upload') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $data['user']->getId() }}">
                        <div class="form-group">
                            <label>Image:</label>
                            <input type="file" name="profile_image" />
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('user.show', Auth::user()->getId() ) }}" class="btn btn-danger">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection