@extends('layouts.app')


@section('content')
<h1 class="">{{ $pageTitle}}</h1>
<div class="container">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    <!-- Controles superiores -->
    <div class="mb-3 d-flex justify-content-between align-items-center">
        <div class="d-flex gap-2">
            <input type="search" class="form-control" style="width: 300px;" placeholder="Buscar proveedor...">
            <button class="btn btn-primary">
                <i class="bi bi-search"></i> Buscar
            </button>
        </div>
        <div>
            <a href="{{route('proveedors.create')}}" class="btn btn-success">
                <i class="bi bi-plus-lg"></i> Agregar Proveedor
            </a>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Fecha Registro</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($proveedors as $proveedor)
                <tr>
                    <td>{{ $proveedor->nombre }} {{ $proveedor->apellido1 }} {{ $proveedor->apellido2 ? $proveedor->apellido2 : '' }}</td>
                    <td>{{ $proveedor->telefono }}</td>
                    <td>{{ $proveedor->ciudad }}, {{ $proveedor->estado }}</td>
                    <td>{{ $proveedor->fecha_registro }}</td>
                    <td>
                        <a href="{{ route('proveedors.edit', $proveedor->id) }}" class="btn btn-primary">Editar</a>
                        <form action="{{ route('proveedors.destroy', $proveedor->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @if ($proveedors->isEmpty())
    <p class="alert alert-info ">No hay proveedores disponibles.</p>             
    @endif
</div>
@endsection
