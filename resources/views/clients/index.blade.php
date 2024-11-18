@extends('layouts.app')


@section('content')
<h1>{{ $pageTitle}}</h1>
<div class="container">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Controles superiores -->
    <div class="mb-3 d-flex justify-content-between align-items-center">
        <div class="d-flex gap-2">
            <input type="search" class="form-control" style="width: 300px;" placeholder="Buscar cliente...">
            <button class="btn btn-primary">
                <i class="bi bi-search"></i> Buscar
            </button>
        </div>
        <div>
            <a href="{{route('clients.create')}}" class="btn btn-success">
                <i class="bi bi-plus-lg"></i> Agregar Cliente
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

 
            @foreach($clients as $client)
            <tr>
                <td>{{ $client->nombre }} {{ $client->apellido1 }} {{ $client->apellido2 ? $client->apellido2 : '' }}</td>
                <td>{{ $client->telefono }}</td>
                <td>{{ $client->ciudad }}, {{ $client->estado }}</td>
                <td>{{ $client->fecha_registro }}</td>
                <td>
                    <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-primary">Editar</a>
                    <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @if ($clients->isEmpty())
    <p class="alert alert-info ">No hay clientes disponibles.</p>             
    @endif
</div>
@endsection
