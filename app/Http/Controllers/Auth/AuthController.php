<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;
use App\Models\Empresa;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{



    // Método para mostrar el formulario de registro
    public function showRegisterForm()
    {
        $empresas = Empresa::all(); // Obtiene todas las empresas existentes
        return view('auth.register', compact('empresas'));
    }
    public function register(Request $request)
    {
        // Esto debería mostrar el contenido de la solicitud
        // dd($request);

        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:5|confirmed',
            'rol' => 'required|string|max:255',
            'empresa_id' => 'nullable',  // Elimina la verificación de existencia para probar
            'nombre' => 'required_if:empresa_id,0|string|max:100',
            'telefono' => 'required_if:empresa_id,0|string|max:11',
        ]);
        


        $empresaId = $request->empresa_id;
        // dd($empresaId);
        // Si se seleccionó "Agregar Nueva Empresa, que tiene el valor de 0", crearla
        if ($empresaId == '0') {
            $empresa = Empresa::create([
                'nombre' => $request->nombre,
                'telefono' => $request->telefono,
            ]);
            // dd($empresa);
            $empresaId = $empresa->id; // Guardar el ID de la nueva empresa
        }
    
        // Crear el nuevo usuario en la base de datos
        Usuario::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'rol' => $request->rol,
            'empresa_id' => $empresaId, // Usar el ID de la empresa (existente o nueva)
        ]);
        // Redireccionar al usuario a la página de login
        return redirect()->route('login')->with('success', 'Usuario registrado exitosamente.');
    }
    




}
