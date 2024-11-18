<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;

class ProveedorController extends Controller
{

    public function create()
    {
        return view('proveedors.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:45',
            'telefono' => 'required|string|size:10',
            'calle' => 'nullable|string|max:100',
            'numero' => 'nullable|string|max:10',
            'colonia' => 'nullable|string|max:100',
            'cod_postal' => 'nullable|string|max:10',
            'ciudad' => 'required|string|max:50',
            'estado' => 'required|string|max:50',
            'pais' => 'nullable|string|max:45',
            'deuda' => 'nullable|numeric|min:0',
        ]);

        // Aquí puedes crear el Proveedor
        Proveedor::create($validatedData);

        
        return redirect()->route('proveedors.index')->with('success', 'Proveedor creado exitosamente.');
    }

    //*MOSTRAR LOS Proveedores EXISTENTES
    public function index()
    {
        $pageTitle = "Panel de Proveedores"; // El título que deseas mostrar en la vista
        // Obtener todos los Proveedors
        $proveedors = Proveedor::all();
        
        // Pasar los Proveedors a la vista del index
        return view('proveedors.index', compact('proveedors','pageTitle'));
    }


    // Método para mostrar el formulario de edición con los datos actuales del Proveedor
    public function edit($id)
    {
        $proveedor = Proveedor::where('id', $id)->firstOrFail();
        return view('proveedors.edit', compact('proveedor'));
    }
        
    
    // Método para actualizar el Proveedoro en la base de datos
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:45',
            'telefono' => 'required|string|size:10',
            'calle' => 'nullable|string|max:100',
            'numero' => 'nullable|string|max:10',
            'colonia' => 'nullable|string|max:100',
            'cod_postal' => 'nullable|string|max:10',
            'ciudad' => 'required|string|max:50',
            'estado' => 'required|string|max:50',
            'pais' => 'nullable|string|max:45',
            'deuda' => 'nullable|numeric|min:0',
        ]);

        // Buscar el Proveedoro y actualizar los valores
        $Proveedor = Proveedor::findOrFail($id);
        $Proveedor->update($validatedData);

        // Redirigir después de la actualización
        return redirect()->route('proveedors.index')->with('success', 'Proveedor actualizado correctamente');
    }

        public function destroy($id)
        {
            // Buscar el Proveedor por su código
            $proveedor = Proveedor::where('id', $id)->firstOrFail();
            
            // Eliminar el Proveedor
            $proveedor->delete();
            
            // Redirigir de vuelta al listado de Proveedores con un mensaje
            return redirect()->route('proveedor.index')->with('success', 'Proveedor eliminado correctamente.');

            // @if (session('success'))
            //     <div class="alert alert-success">
            //         {{ session('success') }}
            //     </div>
            // @endif
        
        }

}
