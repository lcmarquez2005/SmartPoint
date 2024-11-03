<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;
use App\Models\Empresa;
use Illuminate\Support\Facades\Hash;

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
        $request->validate([
            'username' => 'required|string|max:255|unique:usuarios',
            'password' => 'required|string|min:5|confirmed',
            'rol' => 'required|string|max:255',
            'empresa_id' => 'nullable|exists:empresas,id',
            'nombre' => 'required_if:empresa_id,nueva|string|max:255',
            'telefono' => 'required_if:empresa_id,nueva|string|max:20',
        ]);
    
        $empresaId = $request->empresa_id;
    
        // Si se seleccionó "Agregar Nueva Empresa", crearla
        if ($empresaId === 'nueva') {
            $empresa = Empresa::create([
                'nombre' => $request->nombre_nueva_empresa,
                'telefono' => $request->telefono_nueva_empresa,
            ]);
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
