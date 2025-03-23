@extends('layouts.master')
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Users</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Users List</h6>
            <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm"> <i class="fa fa-plus"></i> Add User</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if ($user->profile_picture)
                                        <img src="{{ asset('/storage/uploads/users/profile_picture/' . $user->profile_picture) }}" alt="{{$user->profile_picture}}"
                                            class="img-fluid" style="max-width: 50px">
                                    @endif
                                    {{ $user->name }}
                                </td>
                                <td>{{ $user->email }}</td>
                                <td class="d-flex">
                                    <a href="{{ route('users.edit', $user) }}" class="btn btn-primary btn-md mr-1"
                                        title="Edit">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <form action="{{route('users.destroy', $user)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-md btn-danger show_confirm" title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
    
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No users found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="row mt-4">
                    <div class="col-md-8 g-pg">
                        {{ $users->render('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
