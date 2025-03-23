<?php

namespace App\Http\Controllers;

use App\Http\Requests\Blogs\StoreBlogRequest;
use App\Http\Requests\Blogs\UdpateBlogRequest;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $blogs = Blog::where('title', 'like', '%' . $request->search . '%')
                ->orWhere('slug', 'like', '%' . $request->search . '%')
                ->orWhere('content', 'like', '%' . $request->search . '%')
                ->orWhere('published_at', 'like', '%' . $request->search . '%')
                ->paginate(10);
        } else{
            $blogs = Blog::latest()->paginate(10);
        }
        return view('admin.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {
        try {
            $time = time();

            if ($request->hasfile('image')) {
                $filenamewithextension = $request->file('image')->getClientOriginalName();
                $filename1 = pathinfo($filenamewithextension, PATHINFO_FILENAME);
                $filename = str_replace(' ', '_', $filename1);
                $extension = $request->file('image')->getClientOriginalExtension();
                //filename to store
                $filename_to_store = $filename . '_' . $time . '.' . $extension;

                $main_image = $request->file('image');
                $originalPath = public_path() . '/storage/uploads/blogs/image/';
                if (!File::isDirectory($originalPath)) {
                    File::makeDirectory($originalPath, 0777, true, true);
                }
                $categoryImage = Image::make($main_image);
                $categoryImage->backup();

                $categoryImage->save($originalPath . $filename_to_store);
                $main_image = $filename_to_store;
            } else {
                $main_image = null;
            }

            Blog::create([
                'title' => $request->title,
                'slug' => $request->slug ?? Str::slug($request->title),
                'content' => $request->content,
                'image' => $main_image,
                'author_id' => auth()->id(),
                'published_at' => now(),
            ]);
            toast('Blog Created Successfully.', 'success');
            return redirect()->route('blogs.index');
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return view('admin.blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UdpateBlogRequest $request, Blog $blog)
    {
        try {
            $time = time();

            if ($request->hasfile('image')) {
                if($blog->image){
                    unlink('storage/uploads/blogs/image/' . $blog->image);
                }
                $filenamewithextension = $request->file('image')->getClientOriginalName();
                $filename1 = pathinfo($filenamewithextension, PATHINFO_FILENAME);
                $filename = str_replace(' ', '_', $filename1);
                $extension = $request->file('image')->getClientOriginalExtension();
                //filename to store
                $filename_to_store = $filename . '_' . $time . '.' . $extension;

                $main_image = $request->file('image');
                $originalPath = public_path() . '/storage/uploads/blogs/image/';
                if (!File::isDirectory($originalPath)) {
                    File::makeDirectory($originalPath, 0777, true, true);
                }
                $categoryImage = Image::make($main_image);
                $categoryImage->backup();

                $categoryImage->save($originalPath . $filename_to_store);
                $main_image = $filename_to_store;
            }

            $blog->update([
                'title' => $request->title,
                'slug' => $request->slug ?? Str::slug($request->title),
                'content' => $request->content,
                'image' => $main_image ?? $blog->image,
                'author_id' => auth()->id(),
                'published_at' => now(),
            ]);
            toast('Blog Updated Successfully.', 'success');
            return redirect()->route('blogs.index');
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();

        toast('Blog deleted successfully!', 'success');
        return redirect()->route('blogs.index');
    }
}
