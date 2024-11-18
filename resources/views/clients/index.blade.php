@extends('layouts.app')


@section('content')
<div class="container">
    <h1>{{ $pageTitle}}</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

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
