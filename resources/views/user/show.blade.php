@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex">{{ __('messages.user_profile')}}
                    <a class="ml-auto btn profile-edit-btn" href="{{ route('user.edit', Auth::user()->getId() ) }}"><img src="https://img.icons8.com/android/24/000000/edit.png"></a>
                </div>
                <div class="card-body">
                    <div class="profile-photo-container text-center">
                        <img class="rounded profile-photo" src="{{ URL('https://unitor-static-files.s3.amazonaws.com/profile-photos/'.$data['user']->getAvatar()) }}" alt="profile photo">
                        <br>
                        <a href="{{ route('user.edit_pp', Auth::user()->getId() ) }}">Change photo</a>
                    </div>
                    <table class="table profile-table">
                        <tbody>
                            <tr>
                                <td>{{ __('messages.user_name')}}:</td>
                                <td>{{ $data['user']->getName() }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('messages.user_email')}}:</td>
                                <td>{{ $data['user']->getEmail() }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection