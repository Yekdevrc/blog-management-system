@extends('layouts.master')
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Blogs</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Blog List</h6>
            <a href="{{ route('blogs.create') }}" class="btn btn-primary btn-sm"> <i class="fa fa-plus"></i> Add Blog</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Title</th>
                            <th>Slug</th>
                            <th>Image</th>
                            <th>Author</th>
                            <th>Published Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($blogs as $blog)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    {{ $blog->title }}
                                </td>
                                <td>{{ $blog->slug }}</td>
                                <td>
                                    <a href="{{ asset('/storage/uploads/blogs/image/' . $blog->image) }}" target="_blank">
                                        <img src="{{ asset('/storage/uploads/blogs/image/' . $blog->image) }}"
                                            alt="{{ $blog->image }}" class="img-fluid" style="max-width:80px">
                                    </a>
                                </td>
                                <td>{{ $blog->author->name ?? '' }}</td>
                                <td>{{ $blog->published_at }}</td>
                                <td class="d-flex">
                                    <a href="{{ route('blogs.edit', $blog) }}" class="btn btn-primary btn-md mr-1"
                                        title="Edit">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="{{ route('blogs.show', $blog) }}" class="btn btn-primary btn-md mr-1"
                                        title="Show">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <form action="{{ route('blogs.destroy', $blog) }}" method="post">
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
                                <td colspan="7" class="text-center">No data found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="row mt-4">
                    <div class="col-md-8 g-pg">
                        {{ $blogs->render('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
