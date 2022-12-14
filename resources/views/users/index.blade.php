@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        {{ request()->is('users') ? 'Users' : 'Trashed users' }}
                        <div>
                            <a href="{{ route('users.create') }}" class="btn btn-success btn-sm">Add</a>
                            <a href="{{ route(request()->is('users') ? 'users.trashed' : 'users.index') }}"
                                class="btn btn-secondary btn-sm">{{ request()->is('users') ? 'Trashed users' : 'Users' }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $i => $user)
                                    <tr>
                                        <th scope="row">
                                            {{ $users->currentPage() * $users->perPage() - $users->perPage() + 1 + $i }}
                                        </th>
                                        <td>
                                            <h5 class="mb-0">{{ $user->fullname }}</h5>
                                            @ {{ $user->username }}
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if (request()->is('users'))
                                                <a class="btn-sm btn btn-primary"
                                                    href="{{ route('users.show', $user->id) }}">Show</a>
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                    class="d-inline">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn-sm btn btn-danger">Delete</button>
                                                </form>
                                            @else
                                                <form action="{{ route('users.restore', $user->id) }}" method="POST"
                                                    class="d-inline">
                                                    @method('PATCH')
                                                    @csrf
                                                    <button type="submit" class="btn-sm btn btn-warning">Restore</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
