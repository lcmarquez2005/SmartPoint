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
        $validatedData = $request->validate([
            'cod_pro'=> 'required|string|min:8|unique:productos,cod_pro',
            'nombre' => 'required|string|max:45',
            'cantidad' => 'required|numeric|min:0',//deberiamos manejar que si es por peso, sea gramaje o algo asi
            'precio' => 'required|numeric|min:0',
            'st_minimos' => 'nullable|numeric|min:0',
            'st_minimos' => 'nullable|numeric|min:0',
            'piezas' => 'nullable|integer|min:0',
        ],[
            'cod_pro.unique' => 'El producto ya ha sido registrado.',
            'nombre.max' => 'El nombre no debe exceder los 45 caracteres',
        ]);
        
        // Aquí puedes crear el producto
        Producto::create($validatedData);
        
        return redirect()->route('products.index')->with('success', 'Producto creado exitosamente.');
    }

    public function index()
    {
        $pageTitle = "Panel de Productos"; // El título que deseas mostrar en la vista
        // Obtener todos los productos
        $products = Producto::all();
        
        // Pasar los productos a la vista del dashboard
        return view('products.index', compact('products','pageTitle'));
    }


    // Método para mostrar el formulario de edición con los datos actuales del producto
    public function edit($cod_pro)
    {
        $product = Producto::where('cod_pro', $cod_pro)->firstOrFail();
        return view('products.edit', compact('product'));
    }
        
    
        // Método para actualizar el productoo en la base de datos
        public function update(Request $request, $cod_pro)
        {
            // Validación de los datos
            $validatedData = $request->validate([
                'cod_pro' => 'required|string|min:8',
                'nombre' => 'required|string|max:255',
                'cantidad' => 'required|numeric',
                'precio' => 'required|numeric',
                'st_minimos' => 'nullable|numeric|min:0',
                'st_maximos' => 'nullable|numeric|min:0',
                'piezas' => 'nullable|integer|min:0',
            ]);
    
            // Buscar el productoo y actualizar los valores
            $producto = Producto::findOrFail($cod_pro);
            $producto->update($validatedData);
    
            // Redirigir después de la actualización
            return redirect()->route('products.index')->with('success', 'Producto actualizado correctamente');
        }

        public function destroy($cod_pro)
        {
            // Buscar el producto por su código
            $product = Producto::where('cod_pro', $cod_pro)->firstOrFail();
            
            // Eliminar el producto
            $product->delete();
            
            // Redirigir de vuelta al listado de productos con un mensaje
            return redirect()->route('products.index')->with('success', 'Producto eliminado correctamente.');
        }

}
