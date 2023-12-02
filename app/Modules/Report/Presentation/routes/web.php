<?php

use App\Modules\Report\Presentation\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/report', [ReportController::class, 'index'])->middleware(['auth', 'verified', 'admin'])->name('report');
Route::get('/report/create', [ReportController::class, 'create'])->middleware(['auth', 'verified'])->name('report.create');
Route::post('/report/create', [ReportController::class, 'store'])->middleware(['auth', 'verified']);
Route::delete('/report/{id}', [ReportController::class, 'destroy'])->middleware(['auth', 'verified', 'admin']);

