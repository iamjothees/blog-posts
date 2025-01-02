<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'home'])->name('home');

Route::get('/blogs', [PageController::class, 'blogsIndex'])->name('blogs.index');
Route::get('/blogs/{post:slug}', [PageController::class, 'blogsShow'])->name('blogs.show');

