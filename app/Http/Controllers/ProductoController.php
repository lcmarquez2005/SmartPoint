<?php

namespace App\Http\Controllers;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'cod_pro'=> 'required|string|min:8',
            'nombre' => 'required|string|max:45',
            'cantidad' => 'required|numeric|min:0',//deberiamos manejar que si es por peso, sea gramaje o algo asi
            'precio' => 'required|numeric|min:0',
            'st_minimos' => 'nullable|numeric|min:0',
            'st_minimos' => 'nullable|numeric|min:0',
            'piezas' => 'nullable|integer|min:0',
        ]);

        // Aquí puedes crear el producto
        Producto::create($request->all());

        
        return redirect()->route('dashboard')->with('success', 'Producto creado exitosamente.');
    }

    public function index()
    {
        $pageTitle = "Panel de Productos"; // El título que deseas mostrar en la vista
        // Obtener todos los productos
        $products = Producto::all();
        
        // Pasar los productos a la vista del dashboard
        return view('products.dashboard', compact('products','pageTitle'));
    }

}
