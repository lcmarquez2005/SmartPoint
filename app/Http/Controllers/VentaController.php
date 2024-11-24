<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Venta;
use App\Models\Detalles_venta;
use App\Models\Producto;
use App\Models\Cliente;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
use PhpParser\Node\NullableType;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::all();
        return view('ventas.index', compact('ventas'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $productos = Producto::all();

        // Obtener los productos seleccionados de la sesión
        $productosSelected = collect(session('productosSelected', []));


        // Recalcular el total
        $total = $this->recalcularTotal();

        // Pasar el total y los productos a la vista
        return view('ventas.create', compact('clientes', 'productos','productosSelected', 'total'));
    }



    public function store(Request $request)
    {
        // Validación y procesamiento de la venta
        $validatedData = self::procesarVenta($request);
        $user = Auth::user();
    
        // Empezamos una transacción para asegurarnos de que todo se guarde correctamente
        DB::beginTransaction();
    
        try {
            // Calculamos el total de la venta
            $total = $this->recalcularTotal();
    
            // Crear la venta
            $venta = Venta::create([
                'metodo_pago' => $validatedData['metodo_pago'],
                'cliente_id' => $validatedData['cliente_id'],
                'usuario_id' => $user->id,
                'total' => $total, // Se calculará
            ]);
    
            // Procesar los productos
            foreach ($validatedData['productos'] as $productoDetalle) {
                // Obtener el producto de la base de datos
                $producto = Producto::where('cod_pro', $productoDetalle['cod_pro'])->first();
    
                // Verificar si el producto existe y si hay suficiente stock
                if ($producto) {
                    if ($producto->cantidad >= $productoDetalle['cantidad']) {
                        // Crear el detalle de la venta
                        Detalles_venta::create([
                            'cod_pro' => $productoDetalle['cod_pro'],
                            'venta_id' => $venta->id,
                            'cantidad' => $productoDetalle['cantidad'],
                        ]);
    
                        // Actualizar el stock del producto
                        $producto->cantidad -= $productoDetalle['cantidad']; // Reducir el stock
                        $producto->save(); // Guardar los cambios
                    } else {
                        // Si no hay suficiente stock, lanzamos un error
                        throw new \Exception("No hay suficiente stock para el producto: " . $producto->nombre);
                    }
                } else {
                    // Si el producto no existe, lanzamos un error
                    throw new \Exception("Producto no encontrado: " . $productoDetalle['cod_pro']);
                }
            }
    
            // Si todo es exitoso, confirmamos la transacción
            DB::commit();
    
            // Vaciar los productos seleccionados de la sesión
            $this->vaciarProductos();
    
            // Redirigir con un mensaje de éxito
            return redirect()->route('ventas.index')->with('success', 'Venta creada exitosamente.');
    
        } catch (\Exception $e) {
            DB::rollBack();// Si ocurre un error, revertimos la transacción
    
            // Devolver mensaje de error
            return redirect()->route('ventas.index')->with('error', 'Error al crear la venta: ' . $e->getMessage());
        }
    }
    

    public function procesarVenta(Request $request)
    {

        $validatedData = $request->validate([
            'metodo_pago' => 'required|string|max:45',
            'cliente_id' => 'required|exists:clientes,id',
            'productos' => 'required|array',
            'productos.*.cod_pro' => 'required|exists:productos,cod_pro',
            'productos.*.cantidad' => 'required|numeric|min:1',
        ]);

        // Validación personalizada para asegurarse de que la cantidad no exceda el inventario
        foreach ($validatedData['productos'] as $producto) {
            $productoEnStock = Producto::where('cod_pro', $producto['cod_pro'])->first();
            if ($productoEnStock && $producto['cantidad'] > $productoEnStock->cantidad) {
                return redirect()->back()->withErrors(['productos' => 'La cantidad solicitada para el producto ' . $producto['cod_pro'] . ' excede el stock disponible.']);
            }
        }


        // Redirigir o responder
        return $validatedData;
    }


    public function addProduct(Request $request)
    {
        // Validar los datos recibidos
        $validatedData = $request->validate([
            'cod_pro' => 'required|string',
            'cantidad' => 'required|numeric|min:1',
        ]);
    
        // Recuperar los productos seleccionados como una colección
        $productosSelected = collect(session('productosSelected', []));

        if($this->validarProducto($validatedData, $productosSelected) != null) {
            return $this->validarProducto($validatedData, $productosSelected);
        };
                    
        // Guardar los productos seleccionados en la sesión
        session(['productosSelected' => $productosSelected]);
    
        // Obtener todos los clientes y productos para pasarlos a la vista
        $clientes = Cliente::all();
        $productos = Producto::all();
    
        // Recalcular el total
        $total = $this->recalcularTotal();
    
        // Devolver la vista con los productos seleccionados
        return view('ventas.create', compact('clientes', 'productos', 'productosSelected', 'total'));
    }


    public function validarProducto($validatedData, $productosSelected) {
        // Obtener el producto por código de producto
        $producto = Producto::where('cod_pro', $validatedData['cod_pro'])->first();


        // Verificar si el producto existe en la base de datos
        if (!$producto) {
            return redirect()->back()->withErrors(['error' => 'Producto no encontrado.']);
        }
    
        // Verificar si ya existe en la colección de productos seleccionados (usando cod_pro como clave)
        if ($productosSelected->has($validatedData['cod_pro'])) {
            // Si el producto ya está en la lista, actualizamos su cantidad
            $productoExistente = $productosSelected->get($validatedData['cod_pro']);
            
            // Verificamos si la cantidad solicitada no supera el stock disponible
            if ($productoExistente->cantidad + $validatedData['cantidad'] > $producto->cantidad) {
                return redirect()->back()->withErrors(['error' => 'No hay suficiente stock disponible.']);
            }
            
            // Actualizar la cantidad del producto existente
            $productoExistente->cantidad += $validatedData['cantidad'];
        } else {
            // Si el producto no está en la lista, verificar si hay suficiente stock
            if ($producto->cantidad < $validatedData['cantidad']) {
                return redirect()->back()->withErrors(['error' => 'No hay suficiente stock disponible.']);
            }
    
            // Establece la cantidad seleccionada al objeto Producto
            $producto->cantidad = $validatedData['cantidad'];
    
            // Añadir el nuevo producto a la colección, usando cod_pro como clave
            $productosSelected->put($producto->cod_pro, $producto);
        }

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

        $total = $this->recalcularTotal();

        // Redirigir con un mensaje de éxito
        return redirect()->back()->with('success', 'Producto eliminado exitosamente.')
        ->with('total', $total);
    }

    



    public function vaciarProductos()
    {
        // Vaciar todos los productos seleccionados de la sesión
        session()->forget('productosSelected');
        
        // Recalcular el total
        $total = $this->recalcularTotal();

        //devolver con el mensaje a la vista y con el nuevo total
        return redirect()->back()
        ->with('success', 'Todos los productos seleccionados han sido eliminados.')
        ->with('total', $total);  // Pasar el total calculado a la vista
    }

    public function recalcularTotal()
    {
        // Recuperar los productos seleccionados de la sesión
        $productosSelected = collect(session('productosSelected', []));

        // Calcular el total
        $total = $productosSelected->sum(function ($producto) {
            return $producto->precio * $producto->cantidad;
        });

        // Guardar el total en la sesión o devolverlo como respuesta
        session(['total' => $total]);

        return $total;  // Si lo necesitas como respuesta directa
    }


    
    

}
