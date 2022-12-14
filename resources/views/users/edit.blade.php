@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Edit {{ $user->fullname }}'s profile</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class='text-danger'>{{ $error }}</div>
                            @endforeach
                        @endif

                        <form class="row g-3" action="{{ route('users.update', $user->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="col-md-12">
                                <label for="avatar" class="form-label">Avatar</label>
                                <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*">
                            </div>
                            <div class="col-md-6">
                                <label for="firstname" class="form-label">First name</label>
                                <input type="text" class="form-control" id="firstname" name="firstname"
                                    value="{{ old('firstname', $user->firstname) }}">
                            </div>
                            <div class="col-md-6">
                                <label for="lastname" class="form-label">Last name</label>
                                <input type="text" class="form-control" id="lastname" name="lastname"
                                    value="{{ old('lastname', $user->lastname) }}">
                            </div>
                            <div class="col-md-12">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    value="{{ old('username', $user->username) }}">
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email', $user->email) }}">
                            </div>
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a class="btn btn-secondary" href="{{ route('users.show', $user->id) }}">Show profile</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
