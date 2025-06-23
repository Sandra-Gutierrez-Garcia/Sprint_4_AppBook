<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\WriterController;
use App\Models\Writer;
use App\Models\Book; 
use App\Models\Gnere;

// Rutas de autenticación de writer (colócalas ANTES de las rutas resource)
Route::get('/writer/login', [WriterController::class, 'loginWriter'])->name('writer.login');
Route::post('/writer/login/process', [WriterController::class, 'logeandoWriter'])->name('writer.login.process');
Route::post('/writer/logout',[WriterController:: class, 'exitWriter'])->name('writer.logout');
// Rutas resource
Route::resource('writer', WriterController::class);
Route::resource('book', BookController::class);