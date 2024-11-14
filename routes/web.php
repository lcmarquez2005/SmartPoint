<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ClienteController;


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
Route::get('/login', [AuthController::class, 'create'])->name('login');
Route::post('/login', [AuthController::class, 'store']);
Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');



Route::get('/', [ProductoController::class, 'index'])->middleware('auth')->name('products.index');//vista de inicio si esta autenticado




Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');


//*PRODUCTOS 
//redirecciona a crear producto unicarmente si esta autenticado
Route::get('/products/', [ProductoController::class, 'index'])->middleware('auth')->name('products.index');
Route::get('/products/create', [ProductoController::class, 'create'])->middleware('auth')->name('products.create');
Route::post('/products/store', [ProductoController::class, 'store'])->middleware('auth')->name('products.store');
// Ruta para mostrar el formulario de edición del producto
Route::get('/products/{product}/edit', [ProductoController::class, 'edit'])->middleware('auth')->name('products.edit');
// Ruta para actualizar el producto
Route::put('/products/{product}', [ProductoController::class, 'update'])->middleware('auth')->name('products.update');
Route::delete('/products/{product}', [ProductoController::class, 'destroy'])->middleware('auth')->name('products.destroy');

//*CLIENTES 
//redirecciona a crear producto unicarmente si esta autenticado
Route::get('/clients/', [ClienteController::class, 'index'])->middleware('auth')->name('clients.index');
Route::get('/clients/create', [ClienteController::class, 'create'])->middleware('auth')->name('clients.create');
Route::post('/clients/store', [ClienteController::class, 'store'])->middleware('auth')->name('clients.store');
// Ruta para mostrar el formulario de edición del producto
Route::get('/clients/{clients}/edit', [ClienteController::class, 'edit'])->middleware('auth')->name('clients.edit');
// Ruta para actualizar el producto
Route::put('/clients/{clients}', [ClienteController::class, 'update'])->middleware('auth')->name('clients.update');
Route::delete('/clients/{clients}', [ClienteController::class, 'destroy'])->middleware('auth')->name('clients.destroy');

Route::get('/', function () {  
    return view('welcome');
});