<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\SurtidoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| These routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
*/

// ** Rutas de autenticación **
Route::get('/login', [AuthController::class, 'create'])->name('login');
Route::post('/login', [AuthController::class, 'store']);
Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');

// Registro de usuarios (opcional, solo si es necesario)
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// ** Rutas protegidas por autenticación **
Route::middleware('auth')->group(function () {
    // Página de inicio
    Route::get('/', [ProductoController::class, 'index'])->name('products.index');

    // ** Productos **
    Route::resource('products', ProductoController::class);

    // ** Clientes **
    Route::resource('clients', ClienteController::class);

    // ** Proveedores **
    Route::resource('proveedors', ProveedorController::class);

    // ** Ventas **
    Route::resource('ventas', VentaController::class);

    //** SurtidoController **
    Route::resource('surtir', SurtidoController::class);


    Route::post('/ventas/create', [VentaController::class, 'addProduct'])->name('detalle.create');
    Route::delete('/ventas/producto/{cod_pro}', [VentaController::class, 'removeProduct'])->name('producto.remove');
    //Productos de la session es decir productos que estan por ser vendidos pero no han sido almacenados en la db los cambios
    Route::post('/vaciar-productos', [VentaController::class, 'vaciarProductos'])->name('vaciar.productos');

});


// ** Ruta de bienvenida (para usuarios no autenticados) **
Route::get('/', function () {
    return view('welcome');
});
