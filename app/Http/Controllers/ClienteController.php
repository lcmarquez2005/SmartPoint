<?php

namespace App\Http\Controllers;
use App\Models\Cliente;

use Illuminate\Http\Request;

class ClienteController extends Controller
{

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:45',
            'apellido1' => 'required|string|max:45',
            'apellido2' => 'nullable|string|max:45',
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

        // Aquí puedes crear el Cliente
        Cliente::create($validatedData);

        
        return redirect()->route('clients.index')->with('success', 'Cliente creado exitosamente.');
    }

    //*MOSTRAR LOS CLIENTES EXISTENTES
    public function index()
    {
        $pageTitle = "Panel de Clientes"; // El título que deseas mostrar en la vista
        // Obtener todos los Clientes
        $clients = Cliente::all();
        
        // Pasar los Clientes a la vista del index
        return view('clients.index', compact('clients','pageTitle'));
    }


    // Método para mostrar el formulario de edición con los datos actuales del Cliente
    public function edit($id)
    {
        $client = Cliente::where('id', $id)->firstOrFail();
        return view('clients.edit', compact('client'));
    }
        
    
    // Método para actualizar el Clienteo en la base de datos
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:45',
            'apellido1' => 'required|string|max:45',
            'apellido2' => 'nullable|string|max:45',
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

        // Buscar el Clienteo y actualizar los valores
        $Cliente = Cliente::findOrFail($id);
        $Cliente->update($validatedData);

        // Redirigir después de la actualización
        return redirect()->route('clients.index')->with('success', 'Cliente actualizado correctamente');
    }

        public function destroy($id)
        {
            // Buscar el Cliente por su código
            $client = Cliente::where('id', $id)->firstOrFail();
            
            // Eliminar el Cliente
            $client->delete();
            
            // Redirigir de vuelta al listado de Clientes con un mensaje
            return redirect()->route('client.index')->with('success', 'Producto eliminado correctamente.');

            // @if (session('success'))
            //     <div class="alert alert-success">
            //         {{ session('success') }}
            //     </div>
            // @endif
        
        }

}
