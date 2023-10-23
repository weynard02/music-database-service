<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SongController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/songs', [SongController::class, 'index'])->middleware(['auth', 'verified'])->name('songs');
Route::get('/create', [SongController::class, 'create'])->middleware(['auth', 'verified'])->name('create');;
Route::post('/submit', [SongController::class, 'store'])->middleware(['auth', 'verified']);

Route::get('/admin', [AdminController::class, 'adminHome'])->middleware(['auth', 'verified', 'admin'])->name('admin');
Route::get('/admin/songs', [AdminController::class, 'index'])->middleware(['auth', 'verified', 'admin'])->name('admin.index');
Route::get('/admin/songs/{id}', [AdminController::class, 'show'])->middleware(['auth', 'verified', 'admin'])->name('admin.show');
Route::get('/admin/create', [AdminController::class, 'create'])->middleware(['auth', 'verified', 'admin'])->name('admin.create');
Route::post('/admin/submit', [AdminController::class, 'store'])->middleware(['auth', 'verified', 'admin']);
Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->middleware(['auth', 'verified', 'admin'])->name('admin.edit');
Route::put('/admin/update/{id}', [AdminController::class, 'update'])->middleware(['auth', 'verified', 'admin']);
Route::delete('/admin/delete/{id}', [AdminController::class, 'destroy'])->middleware(['auth', 'verified', 'admin']);

require __DIR__.'/auth.php';
