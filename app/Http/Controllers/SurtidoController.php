<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Surtido;
use App\Models\Producto;
use App\Models\Cliente;
use App\Models\Proveedor;

class SurtidoController extends Controller
{
    //
    //

    public function index()
    {
        $proveedores = Proveedor::all();
        $productos = Producto::all();

        // Obtener los productos seleccionados de la sesión
        $productosSelected = collect(session('productosSelected', []));


        // Recalcular el total
        // $total = $this->recalcularTotal();

        // Pasar el total y los productos a la vista
        return view('surtir.index', compact('proveedores', 'productos', 'productosSelected'));
    }

    //     public function create() {
    //         return view('surtir.create')
    //     }
    //
}
