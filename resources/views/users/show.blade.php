@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $user->fullname }}'s profile</div>

                    <div class="card-body text-center">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <img src="{{ asset($user->avatar) }}" width="200px">

                        <h1>{{ $user->fullname }}</h1>
                        <h2>@ {{ $user->username }}</h2>

                        <div class="d-flex justify-content-center gap-1">
                            <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}">Edit</a>
                            <button class="btn btn-danger">Delete</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
