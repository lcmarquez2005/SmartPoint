@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h2 class="h1 me-3">Detalles de la Venta #{{ $venta->id }}</h2>
        <a href="{{ route('ventas.index') }}" class="btn btn-danger d-block">
            <i class="bi bi-arrow-return-left"></i> Volver
        </a>
    </div>
    
    <!-- Información general de la venta -->
    <div class="card mb-4">
        <div class="card-body">
            <h4 class="card-title">Información General</h4>
            <p><strong>Cliente:</strong> {{ $venta->cliente->nombre }}</p>
            <p><strong>Usuario realizo la venta:</strong> {{ $venta->usuario->username }}</p>
            <p><strong>Método de Pago:</strong> {{ $venta->metodo_pago }}</p>
            <p><strong>Total:</strong> ${{ number_format($venta->total, 2) }}</p>
            <p><strong>Fecha y Hora: </strong>{{ $venta->fecha->format('d-m-Y - H:i:s') }}</p>

        </div>
    </div>

    <!-- Tabla de detalles de productos -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Detalles de Productos</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    
                @foreach ($venta->detalles_ventas as $detalle)
                    @if ($detalle->producto)
                        <tr>
                            <td>{{ $detalle->producto->cod_pro }}</td>
                            <td>{{ $detalle->producto->nombre }}</td>
                            <td>{{ $detalle->cantidad }}</td>
                            <td>${{ number_format($detalle->producto->precio, 2) }}</td>
                            <td>${{ number_format($detalle->cantidad * $detalle->producto->precio, 2) }}</td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="5" class="text-center text-danger">Producto no encontrado</td>
                        </tr>
                    @endif
                @endforeach
                
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-end"><strong>Total:</strong></td>
                        <td>${{ number_format($venta->total, 2) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
