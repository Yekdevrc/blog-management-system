@extends('layouts.master')
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Users</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Edit User</h6>
            <a href="{{ route('users.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-list"></i> User List</a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-5">
                        <form class="users" method="post" action="{{route('users.update', $user)}}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label class="form-label">Full Name <span class="text-danger"> *</span> </label>
                                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                        class="form-control form-control-user @error('name')
                                        is-invalid
                                    @enderror"
                                        id="exampleFirstName" placeholder="Full Name">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label class="form-label">Email <span class="text-danger"> *</span> </label>
                                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                        class="form-control form-control-user @error('email')
                                        is-invalid
                                    @enderror"
                                        id="exampleFirstName" placeholder="Email Address">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label class="form-label">Password <span class="text-danger"> *</span> </label>
                                    <input type="password" name="password"
                                        class="form-control form-control-user @error('password')
                                        is-invalid
                                    @enderror"
                                        id="exampleInputPassword" placeholder="Password">
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Confirmed Password <span class="text-danger"> *</span>
                                    </label>
                                    <input type="password" name="password_confirmation"
                                        class="form-control form-control-user @error('password_confirmation')
                                        is-invalid
                                    @enderror"
                                        id="exampleRepeatPassword" placeholder="Repeat Password">
                                    @error('password_confirmation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label class="form-label">Profile Picture</label>
                                    <input type="file" name="profile_picture"
                                        class="form-control form-control-user @error('profile_picture')
                                        is-invalid
                                    @enderror"
                                        id="profile-picture" accept=".jpg, .jpeg, .png">
                                    @error('profile_picture')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    @if ($user->profile_picture)
                                        <img src="{{ asset('/storage/uploads/users/profile_picture/' . $user->profile_picture) }}" alt="Profile Photo"
                                            class="img-fluid" style="max-width: 100px">
                                    @endif
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
