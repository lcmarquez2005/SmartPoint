<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Detalles_venta;
use App\Models\Producto;
use App\Models\Cliente;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::with('cliente', 'detalles.producto')->get();
        return view('ventas.index', compact('ventas'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $productos = Producto::all();
        return view('ventas.create', compact('clientes', 'productos'));
    }

    public function store(Request $request)
    {
        $mensaje = self::procesarVenta($request);

        $validatedData = $request->validate([
            'metodo_pago' => 'nullable|string|max:45',
            'cliente_id' => 'required|exists:clientes,id',
            'usuario_id' => 'required|exists:usuarios,id',
            'productos' => 'required|array',
            'productos.*.cod_pro' => 'required|exists:productos,cod_pro',
            'productos.*.cantidad' => 'required|numeric|min:1',
        ]);

        // Crear la venta
        $venta = Venta::create([
            'metodo_pago' => $validatedData['metodo_pago'],
            'cliente_id' => $validatedData['cliente_id'],
            'usuario_id' => $validatedData['usuario_id'],
            'total' => 0, // Se calculará
        ]);

        $total = 0;

        // Agregar detalles de la venta
        foreach ($validatedData['productos'] as $productoDetalle) {
            $producto = Producto::where('cod_pro', $productoDetalle['cod_pro'])->first();
            $subtotal = $producto->precio * $productoDetalle['cantidad'];
            $total += $subtotal;

            Detalles_venta::create([
                'cod_pro' => $productoDetalle['cod_pro'],
                'venta_id' => $venta->id,
                'cantidad' => $productoDetalle['cantidad'],
            ]);
        }

        // Actualizar el total de la venta
        $venta->update(['total' => $total]);

        return redirect()->route('ventas.index')->with('success', 'Venta creada exitosamente.');
    }

    public function procesarVenta(Request $request)
    {
        $request->validate([
            'productos.*.cod_pro' => 'required|string',
            'productos.*.cantidad' => 'required|integer|min:1',
        ]);
        
        $productos = $request->input('productos'); // Obtiene todos los productos
        

        // Procesar los datos (por ejemplo, guardarlos en la base de datos)
        Detalles_venta::create($productos);

        // Redirigir o responder
        return "Datos procesados Correctamente";
    }
    public function addProduct(Request $request)
    {
        $validatedData = $request->validate([
            'cod_pro' => 'required|string',
            'cantidad' => 'required|integer|min:1',
        ]);
    
        // Recuperar los productos seleccionados como una colección
        $productosSelected = collect(session('productosSelected', []));
    
        // Obtener el producto por código de producto
        $producto = Producto::where('cod_pro', $validatedData['cod_pro'])->first();
    
        // Verifica si el producto existe
        if (!$producto) {
            return redirect()->back()->withErrors(['error' => 'Producto no encontrado.']);
        }
    
        // Verifica si ya existe en los productos seleccionados
        $productoExistente = $productosSelected->firstWhere('cod_pro', $validatedData['cod_pro']);
    
        if ($productoExistente) {
            // Si el producto ya está en la lista, suma la cantidad
            $productosSelected = $productosSelected->map(function ($prod) use ($validatedData) {
                if ($prod->cod_pro === $validatedData['cod_pro']) {
                    $prod->cantidad += $validatedData['cantidad'];
                }
                return $prod;
            });
        } else {
            // Si no está, verificar el stock antes de agregarlo
            if ($producto->cantidad < $validatedData['cantidad']) {
                return redirect()->back()->withErrors(['error' => 'No hay suficiente stock disponible.']);
            }
    
            // Establece la cantidad seleccionada al objeto Producto
            $producto->cantidad = $validatedData['cantidad'];
            $productosSelected->push($producto);
        }
    
        // Guardar los productos seleccionados en la sesión
        session(['productosSelected' => $productosSelected]);
    
        // Obtener todos los clientes y productos para pasarlos a la vista
        $clientes = Cliente::all();
        $productos = Producto::all();
    
        // Devolver la vista con los productos seleccionados
        return view('ventas.create', compact('clientes', 'productos', 'productosSelected'));
    }

    public function removeProduct($cod_pro)
    {
        // Recuperar los productos seleccionados como una colección
        $productosSelected = collect(session('productosSelected', []));

        // Filtrar los productos, excluyendo el producto con el código especificado
        $productosFiltered = $productosSelected->filter(function ($producto) use ($cod_pro) {
            return $producto->cod_pro !== $cod_pro;
        });

        // Actualizar la sesión con la colección filtrada
        session(['productosSelected' => $productosFiltered]);

        // Redirigir con un mensaje de éxito
        return redirect()->back()->with('success', 'Producto eliminado exitosamente.');
    }

    
    

}
