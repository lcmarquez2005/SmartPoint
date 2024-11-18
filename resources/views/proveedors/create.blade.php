@extends('layouts.app')

@section('content')

<a href="{{route('proveedors.index')}}" class="btn btn-danger">
    <i class="bi bi-arrow-return-left"></i> Volver
</a>
<h1 class="text-center mb-4">{{ isset($proveedor) ? 'Editar Proveedor' : 'Registrar Proveedor' }}</h1>
<div class="container-md">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ isset($proveedor) ? route('proveedors.update', $proveedor->id) : route('proveedors.store') }}" method="POST" class="bg-white p-4 rounded shadow-sm">
                @csrf
                @if (isset($proveedor))
                    @method('PUT')
                @endif
                <div class="row mb-3">
                    <div class="col-12">
                        <label for="nombre">*Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $proveedor->nombre ?? '') }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="telefono">*Teléfono:</label>
                        <input type="tel" class="form-control" id="telefono" name="telefono" value="{{ old('telefono', $proveedor->telefono ?? '') }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12">
                        <label for="deuda">Deuda:</label>
                        <input type="number" class="form-control" id="deuda" name="deuda" value="{{ old('deuda', $proveedor->deuda ?? '') }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-8">
                        <label for="calle">Calle:</label>
                        <input type="text" class="form-control" id="calle" name="calle" value="{{ old('calle', $proveedor->calle ?? '') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="numero">Número:</label>
                        <input type="text" class="form-control" id="numero" name="numero" maxlength="10" value="{{ old('numero', $proveedor->numero ?? '') }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-8">
                        <label for="colonia">Colonia:</label>
                        <input type="text" class="form-control" id="colonia" name="colonia" value="{{ old('colonia', $proveedor->colonia ?? '') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="C_P">Código postal:</label>
                        <input type="text" class="form-control" id="C_P" name="cod_postal" maxlength="10" value="{{ old('cod_postal', $proveedor->cod_postal ?? '') }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="ciudad">*Ciudad:</label>
                        <input type="text" class="form-control" id="ciudad" name="ciudad" maxlength="50" value="{{ old('ciudad', $proveedor->ciudad ?? '') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="estado">*Estado:</label>
                        <input type="text" class="form-control" id="estado" name="estado" maxlength="50" value="{{ old('estado', $proveedor->estado ?? '') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="pais">*País:</label>
                        <input type="text" class="form-control" id="pais" name="pais" maxlength="50" value="{{ old('pais', $proveedor->pais ?? '') }}">
                    </div>
                </div>

                <div class="d-flex justify-content-center gap-2">
                    <button type="submit" class="btn btn-dark">
                        <i class="bi bi-save"></i> Guardar
                    </button>
                    <button type="button" class="btn btn-secondary">
                        <i class="bi bi-arrow-clockwise"></i> Actualizar
                    </button>
                    <button type="button" class="btn btn-danger">
                        <i class="bi bi-trash"></i> Eliminar
                    </button>
                    <button type="button" class="btn btn-primary">
                        <i class="bi bi-plus"></i> Nuevo
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
