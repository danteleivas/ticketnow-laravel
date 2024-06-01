<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MercadoPagoController;
use App\Http\Controllers\MiCuentaController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\ShowController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/buscar', [HomeController::class, 'buscar'])->name('buscar');

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');


Route::get('/admin', [AdminController::class, 'index'])->name('admin')->middleware('admin');
Route::post('/admin', [AdminController::class, 'showStore'])->name('admin.showStore')->middleware('admin');
Route::post('/storePlace', [AdminController::class, 'placeStore'])->name('admin.placeStore')->middleware('admin');
Route::get('/showEdit/{id}', [AdminController::class, 'showEdit'])->name('admin.showEdit')->middleware('admin');
Route::put('/showUpdate/{id}', [AdminController::class, 'showUpdate'])->name('admin.showUpdate')->middleware('admin');
Route::delete('/showDelete/{id}', [AdminController::class, 'showDelete'])->name('admin.showDelete')->middleware('admin');

Route::get('/register', [RegisterUserController::class, 'register'])->name('register');
Route::post('/register', [RegisterUserController::class, 'store'])->name('register.store');

Route::get('/show/{id}', [ShowController::class, 'mostrar'])->name('show');

Route::get('/detalle', [CompraController::class, 'detalle'])->name('detalle')->middleware(['auth', 'noAdmin']);
Route::post('/detalle', [CompraController::class, 'detalle'])->name('detalle')->middleware(['auth', 'noAdmin']);


Route::get('/exito', [CompraController::class, 'exito'])->name('exito')->middleware(['auth', 'noAdmin']);;

Route::get('/micuenta', [MiCuentaController::class, 'micuenta'])->name('micuenta')->middleware(['auth', 'noAdmin']);;











