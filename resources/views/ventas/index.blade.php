@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ventas Realizadas</h1>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Método de Pago</th>
                <th>Total</th>
                <th>Fecha</th>
                <th>Ver Mas...</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ventas as $venta)
            <tr>
                <td>{{ $venta->id }}</td>
                <td>{{ $venta->id }}</td>
                <td>{{ $venta->cliente->nombre }}</td>
                <td>{{ $venta->metodo_pago }}</td>
                <td>${{ number_format($venta->total, 2) }}</td>
                <td>{{ $venta->fecha }}</td>
                <td>
                    <form action="{{ route('ventas.show', ['venta' => $venta->id]) }}" method="GET">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-plus-lg"></i> Ver Venta
                        </button>
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
