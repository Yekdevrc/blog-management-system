<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect(route('login'));
});

Route::get('/dashboard', function () {
    $users = User::count();
    $blogs = Blog::count();
    return view('dashboard', compact('users', 'blogs'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('/users')->as('users.')->controller(UserController::class)->group(function () {
        Route::get('/index', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{user}', 'edit')->name('edit');
        Route::put('/update/{user}', 'update')->name('update');
        Route::delete('/destroy/{user}', 'destroy')->name('destroy');
    });

    //Blogs
    Route::prefix('/blogs')->as('blogs.')->controller(BlogController::class)->group(function(){
        Route::get('/index', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/show/{blog}', 'show')->name('show');
        Route::get('/edit/{blog}', 'edit')->name('edit');
        Route::put('/update/{blog}', 'update')->name('update');
        Route::delete('/destroy/{blog}', 'destroy')->name('destroy');
    });
});

require __DIR__.'/auth.php';
