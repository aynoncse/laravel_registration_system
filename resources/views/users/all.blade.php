@extends('layouts.app')
 
@section('content')
<div class="container">
    @if(session()->has('status'))
        <p class="alert alert-info">
            {{  session()->get('status') }}
        </p>
    @endif
    <div class="card ">
        <div class="card-header">
            User Listing
            <a href="{{ route('users.create') }}" class="btn btn-success btn-xs float-right">Add User</a>
        </div>
        <div class="card-body">
            @if (count($users))
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-dark">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Created On</th>
                                <th>Last Updated</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ date('d, M Y', strtotime($user->created_at))}}</td>
                                <td>{{ date('d, M Y', strtotime($user->updated_at))}}</td>
                                <td align="center">
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-success btn-xs"><i class="fas fa-edit"></i> Edit</a>
                                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-info btn-xs"><i class="fas fa-eye"></i> View</a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline-block">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button class="btn btn-danger btn-xs">
                                            <i class="fas fa-trash-alt"></i><span> DELETE</span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-center">
                    {{ $users->links() }}
                </div>
            @else
                <p class="alert alert-info">
                    No Listing Found
                </p>
            @endif
        </div>
    </div>
</div>
@endsection