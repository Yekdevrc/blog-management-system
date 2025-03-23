@extends('layouts.master')
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Blogs</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Show Blog</h6>
            <a href="{{ route('blogs.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-list"></i> Blog List</a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-4">
                            <strong>Title:</strong>
                            <div class="card mb-4 py-3 border-left-primary">
                                <div class="card-body">
                                    {{ $blog->title }}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <strong>Slug:</strong>
                            <div class="card mb-4 py-3 border-left-primary">
                                <div class="card-body">
                                    {{ $blog->slug }}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <strong>Published Date:</strong>
                            <div class="card mb-4 py-3 border-left-primary">
                                <div class="card-body">
                                    {{ $blog->published_at }}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <strong>Author</strong>
                            <div class="card mb-4 py-3 border-left-primary">
                                <div class="card-body">
                                    {{ $blog->author->name ?? '' }}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <strong>Image</strong>
                            <div class="card mb-4 py-3 border-left-primary">
                                <div class="card-body">
                                    <a href="{{ asset('storage/uploads/blogs/image/' . $blog->image) }}" target="_blank">
                                        <img src="{{ asset('storage/uploads/blogs/image/' . $blog->image) }}"
                                            alt="{{ $blog->title }}" class="img-fluid" height="100" width="100">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <strong>Content</strong>
                            <div class="card mb-4 py-3 border-left-primary">
                                <div class="card-body">
                                    {!! $blog->content !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
