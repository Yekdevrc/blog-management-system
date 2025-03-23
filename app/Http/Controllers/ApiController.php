<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function blogs()
    {
        $blogs = Blog::select('title', 'slug', 'image', 'content', 'published_at')->get();
        return response()->json([
            'blogs' => $blogs
        ]);
    }

    public function blog($id)
    {
        $blog = Blog::select('title', 'slug', 'image', 'content', 'published_at')->find($id);
        return response()->json([
            'blog' => $blog
        ]);
    }
}
