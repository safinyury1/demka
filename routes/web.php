<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () { return view('dashboard');})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    

    Route::get('/reports',[ReportController::class, 'index'])->name('reports.index');

    Route::get('/reports/create', function () { return view('reports.create'); })->name('reports.create');

    Route::get('/reports/{report}',[ReportController::class,'show'])->name('reports.show');

    Route::get('/reports/{report}/edit',[ReportController::class,'edit'])->name('reports.edit');

    Route::put('/reports/{report}',[ReportController::class,'update'])->name('reports.update');

    Route::post('/reports', [ReportController::class, 'store'])->name('reports.store');

    Route::delete('/reports/{report}',[ReportController::class, 'destroy'])->name('reports.destroy');
});

Route::middleware((Admin::class))->group(function(){

    Route::get('/admin', function (){ return view('admin.index');})->name('admin.index');
    
});


require __DIR__.'/auth.php';