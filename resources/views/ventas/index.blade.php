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
            </tr>
        </thead>
        <tbody>
            @foreach ($ventas as $venta)
                <tr>
                    <td>{{ $venta->id }}</td>
                    <td>{{ $venta->cliente->nombre }}</td>
                    <td>{{ $venta->metodo_pago }}</td>
                    <td>${{ number_format($venta->total, 2) }}</td>
                    <td>{{ $venta->fecha }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
