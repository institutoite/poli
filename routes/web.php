<?php

use Illuminate\Support\Facades\Route;
use App\Controllers\AeronaveController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PDFController;

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

Route::middleware(['auth'])->group(function () {
    Route::resource('aeronaves', AeronaveController::class);
});

Route::get('/exportar-pdf', [PDFController::class, 'exportarPDF'])->name('exportar.pdf');


