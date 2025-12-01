<?php

use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/reports', 
[ReportController::class, 'index'])
->name('reports.index');

Route::get('/reports/create', function () { return view('reports.create'); })->name('reports.create');

Route::get('/reports/{report}',[ReportController::class,'show'])->name('reports.show');

Route::get('/reports/{report}/edit',[ReportController::class,'edit'])->name('reports.edit');

Route::put('/reports/{report}',[ReportController::class,'update'])->name('reports.update');

Route::post('/reports', [ReportController::class, 'store'])->name('reports.store');

Route::delete('/reports/{report}',[ReportController::class, 'destroy'])->name('reports.destroy');



