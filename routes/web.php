<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\UserController;
use App\Models\Playlist;
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

Route::get('/dashboard', [SongController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/songs', [SongController::class, 'index'])->middleware(['auth', 'verified'])->name('songs');
Route::get('/songs/{id}', [SongController::class, 'show'])->middleware(['auth', 'verified']);
Route::get('/songs/fav/{id}', [SongController::class, 'setFavorite'])->middleware(['auth', 'verified']);
Route::get('/create', [SongController::class, 'create'])->middleware(['auth', 'verified'])->name('create');;
Route::post('/submit', [SongController::class, 'store'])->middleware(['auth', 'verified']);
Route::get('/playlists', [PlaylistController::class, 'index'])->middleware(['auth', 'verified'])->name('playlist');
Route::get('/playlists/create', [PlaylistController::class, 'create'])->middleware(['auth', 'verified']);
Route::post('/playlists/create', [PlaylistController::class, 'store'])->middleware(['auth', 'verified']);
Route::post('/playlists/add/{id}', [PlaylistController::class, 'storePivot'])->middleware(['auth', 'verified']);
Route::get('/playlists/{id}', [PlaylistController::class, 'show'])->middleware(['auth', 'verified']);
Route::delete('/playlists/{playlistId}/{songId}', [PlaylistController::class, 'destroyPivot'])->middleware(['auth', 'verified']);


Route::get('/admin', [AdminController::class, 'adminHome'])->middleware(['auth', 'verified', 'admin'])->name('admin');
Route::get('/admin/songs', [AdminController::class, 'index'])->middleware(['auth', 'verified', 'admin'])->name('admin.index');
Route::get('/admin/songs/{id}', [AdminController::class, 'show'])->middleware(['auth', 'verified', 'admin'])->name('admin.show');
Route::get('/admin/create', [AdminController::class, 'create'])->middleware(['auth', 'verified', 'admin'])->name('admin.create');
Route::post('/admin/submit', [AdminController::class, 'store'])->middleware(['auth', 'verified', 'admin']);
Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->middleware(['auth', 'verified', 'admin'])->name('admin.edit');
Route::put('/admin/update/{id}', [AdminController::class, 'update'])->middleware(['auth', 'verified', 'admin']);
Route::delete('/admin/delete/{id}', [AdminController::class, 'destroy'])->middleware(['auth', 'verified', 'admin']);

Route::get('/admin/users', [UserController::class, 'index'])->middleware(['auth', 'verified', 'admin'])->name('admin.index.user');

require __DIR__.'/auth.php';
