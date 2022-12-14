@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Activity log
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Employee</th>
                                    <th scope="col">Action</th>
                                    <th scope="col">Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($logs as $i => $log)
                                    <tr>
                                        <th scope="row">
                                            {{ $logs->currentPage() * $logs->perPage() - $logs->perPage() + 1 + $i }}
                                        </th>
                                        <td>
                                            <h5 class="mb-0">{{ $log->user->fullname }}</h5>
                                            @ {{ $log->user->username }}
                                        </td>
                                        <td>{{ $log->message }}</td>
                                        <td>{{ $log->created_at->diffForHumans() }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No records found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $logs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
