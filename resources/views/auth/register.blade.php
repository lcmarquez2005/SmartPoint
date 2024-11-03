@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header text-center bg-primary text-white">
                <h4>Registro de Usuario</h4>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Nombre de Usuario -->
                    <div class="form-group mb-3">
                        <label for="username">Nombre de Usuario</label>
                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autofocus>
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Contraseña -->
                    <div class="form-group mb-3">
                        <label for="password">Contraseña</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Confirmar Contraseña -->
                    <div class="form-group mb-3">
                        <label for="password_confirmation">Confirmar Contraseña</label>
                        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                    </div>

                    <!-- Rol -->
                    <div class="form-group mb-3">
                        <label for="rol">Rol</label>
                        <input id="rol" type="text" class="form-control @error('rol') is-invalid @enderror" name="rol" value="{{ old('rol') }}" required>
                        @error('rol')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <!-- Combobox para seleccionar la empresa -->
                    <div class="form-group">
                        <label for="empresa_id">Empresa</label>
                        <select id="empresa_id" name="empresa_id" class="form-control" onchange="toggleNewEmpresaInput(this)">
                            <option value="">Seleccione una empresa</option>
                            @foreach ($empresas as $empresa)
                                <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                            @endforeach
                            <option value="0">Agregar Nueva Empresa + </option>
                        </select>
                    </div>

                    <!-- Campo de texto para nombre de nueva empresa (oculto por defecto) -->
                    <div id="nueva_empresa" style="display: none;">
                        <div class="form-group">
                            <label for="nombre">Nombre de la Nueva Empresa</label>
                            <input type="text" id="nombre" name="nombre" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="telefono">Teléfono de la Nueva Empresa</label>
                            <input type="text" id="telefono" name="telefono" class="form-control">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Registrarse</button>
                </form>

            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('empresa_id').addEventListener('change', function () {
        const nuevaEmpresaFields = document.getElementById('nueva_empresa');
        if (this.value === '0') {
            nuevaEmpresaFields.style.display = 'block';
        } else {
            nuevaEmpresaFields.style.display = 'none';
        }
    });
</script>
@endsection
