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
                        <h3>{{ $user->profile?->country }}</h3>

                        <div class="d-flex justify-content-center gap-1">
                            @can('edit-user')
                                <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}">Edit</a>
                            @endcan
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
