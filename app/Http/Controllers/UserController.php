<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\updateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $users = User::where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%')
                ->paginate(10);
        } else {
            $users = User::latest()->paginate(10);
        }
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        try {
            $time = time();

            if ($request->hasfile('profile_picture')) {
                $filenamewithextension = $request->file('profile_picture')->getClientOriginalName();
                $filename1 = pathinfo($filenamewithextension, PATHINFO_FILENAME);
                $filename = str_replace(' ', '_', $filename1);
                $extension = $request->file('profile_picture')->getClientOriginalExtension();
                //filename to store
                $filename_to_store = $filename . '_' . $time . '.' . $extension;

                $main_image = $request->file('profile_picture');
                $originalPath = public_path() . '/storage/uploads/users/profile_picture/';
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

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'profile_picture' => $main_image ?? null,
            ]);
            toast('User Created Successfully.', 'success');
            return redirect()->route('users.index');
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateUserRequest $request, User $user)
    {
        try {
            $time = time();

            if ($request->hasfile('profile_picture')) {
                // if($user->profile_picture){
                //     unlink('/storage/uploads/users/profile_picture/' . $user->profile_picture);
                // }
                $filenamewithextension = $request->file('profile_picture')->getClientOriginalName();
                $filename1 = pathinfo($filenamewithextension, PATHINFO_FILENAME);
                $filename = str_replace(' ', '_', $filename1);
                $extension = $request->file('profile_picture')->getClientOriginalExtension();
                //filename to store
                $filename_to_store = $filename . '_' . $time . '.' . $extension;

                $main_image = $request->file('profile_picture');
                $originalPath = public_path() . '/storage/uploads/users/profile_picture/';
                if (!File::isDirectory($originalPath)) {
                    File::makeDirectory($originalPath, 0777, true, true);
                }
                $categoryImage = Image::make($main_image);
                $categoryImage->backup();

                $categoryImage->save($originalPath . $filename_to_store);
                $main_image = $filename_to_store;
            }

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'profile_picture' => $main_image ?? $user->profile_picture,
            ]);
            toast('User Created Successfully.', 'success');
            return redirect()->route('users.index');
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if($user->profile_picture){
            unlink('uploads/profile_picture/' . $user->profile_picture);
        }
        $user->delete();
        toast('User Deleted Successfully.', 'success');
        return redirect()->route('users.index');
    }
}
