@extends('layouts.master')
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Blogs</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Edit Blog</h6>
            <a href="{{ route('blogs.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-list"></i> Blog List</a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-5">
                        <form class="users" method="post" action="{{ route('blogs.update', $blog) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label class="form-label">Title<span class="text-danger"> *</span> </label>
                                    <input type="text" name="title" value="{{ old('title', $blog->title) }}"
                                        class="form-control form-control-user @error('title')
                                        is-invalid
                                    @enderror"
                                        id="exampleFirstName" placeholder="Title">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label class="form-label">Slug <span class="text-danger"> *</span> </label>
                                    <input type="text" name="slug" value="{{ old('slug', $blog->slug) }}"
                                        class="form-control form-control-user @error('slug')
                                        is-invalid
                                    @enderror"
                                        id="exampleFirstName" placeholder="Slug">
                                    @error('slug')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label class="form-label">Image <span class="text-danger"> </span> </label>
                                    <input type="file" name="image"
                                        class="form-control form-control-user @error('image')
                                        is-invalid
                                    @enderror"
                                        id="exampleInputPassword" placeholder="image">
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    @if ($blog->image)
                                        <img src="{{ asset('/storage/uploads/blogs/image/' . $blog->image) }}"
                                            alt="{{ $blog->image }}" class="img-fluid" style="max-width:80px">
                                        
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12 mb-3 mb-sm-0">
                                    <label class="form-label">Content</label>
                                    <textarea name="content" class="form-control form-control-user @error('content')
                                        is-invalid                                        
                                    @enderror"
                                        id="description" placeholder="Content">{{ old('content', $blog->content) }}</textarea>
                                    @error('content')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
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
