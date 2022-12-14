@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        {{ request()->is('users') ? 'Users' : 'Trashed users' }}
                        <div>
                            @if (request()->is('users'))
                                @can('create-user')
                                    <a href="{{ route('users.create') }}" class="btn btn-success btn-sm">Add</a>
                                @endcan
                                @can('list-deleted-user')
                                    <a href="{{ route('users.trashed') }}" class="btn btn-secondary btn-sm">Trashed users</a>
                                @endcan
                            @else
                                @can('list-user')
                                    <a href="{{ route('users.index') }}" class="btn btn-secondary btn-sm">Users</a>
                                @endcan
                            @endif
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
                                @forelse ($users as $i => $user)
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
                                                @can('show-user')
                                                    <a class="btn-sm btn btn-primary"
                                                        href="{{ route('users.show', $user->id) }}">Show</a>
                                                @endcan
                                                @can('edit-user')
                                                    <a class="btn-sm btn btn-warning"
                                                        href="{{ route('users.edit', $user->id) }}">Edit</a>
                                                @endcan

                                                @can('delete-user')
                                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                        class="d-inline">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn-sm btn btn-danger">Delete</button>
                                                    </form>
                                                @endcan
                                            @else
                                                @can('restore-user')
                                                    <form action="{{ route('users.restore', $user->id) }}" method="POST"
                                                        class="d-inline">
                                                        @method('PATCH')
                                                        @csrf
                                                        <button type="submit" class="btn-sm btn btn-warning">Restore</button>
                                                    </form>
                                                @endcan
                                                @can('force-delete-user')
                                                    <form action="{{ route('users.delete', $user->id) }}" method="POST"
                                                        class="d-inline">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn-sm btn btn-danger">Delete
                                                            permanently</button>
                                                    </form>
                                                @endcan
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No records found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
