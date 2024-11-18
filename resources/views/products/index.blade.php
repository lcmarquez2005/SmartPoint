@extends('layouts.app')

    
    @section('content')

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <h1 class="mb-4">{{$pageTitle}}</h1>
    <div class="container-fluid px-4">
        <!-- Controles superiores -->
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <div class="d-flex gap-2">
                <input type="search" class="form-control" style="width: 300px;" placeholder="Buscar producto...">
                <button class="btn btn-primary">
                    <i class="bi bi-search"></i> Buscar
                </button>
            </div>
            <div>
                <a href="{{route('products.create')}}" class="btn btn-success">
                    <i class="bi bi-plus-lg"></i> Agregar producto
                </a>
            </div>
        </div>

        <!-- Tabla de productos -->
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="border">Cod Producto</th>
                        <th scope="col" class="border">Nombre</th>
                        <th scope="col" class="border">Cantidad</th>
                        <th scope="col" class="border">Precio</th>
                        <th scope="col" class="border">Minimo</th>
                        <th scope="col" class="border">Maximo</th>
                        <th scope="col" class="border">Piezas</th>
                        <th scope="col" class="border">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td class="py-2 px-4">{{ $product->cod_pro }}</td>
                            <td class="py-2 px-4">{{ $product->nombre }}</td>
                            <td class="py-2 px-4">{{ number_format($product->cantidad, 2) }}</td>
                            <td class="py-2 px-4">${{ number_format($product->precio, 2) }}</td>
                            <td class="py-2 px-4">{{ number_format($product->st_minimos, 2) }}</td>
                            <td class="py-2 px-4">{{ number_format($product->st_maximos, 2) }}</td>
                            <td class="py-2 px-4">{{ number_format($product->piezas, 2) }}</td>
                            <td class="py-2 px-4">
                                <a href="{{ route('products.edit', $product->cod_pro) }}" class="btn w-100 mb-2 btn-primary">Editar</a>
                                
                                <!-- Formulario de eliminación con confirmación -->
                                <form action="{{ route('products.destroy', $product->cod_pro) }}" method="POST" onsubmit="return confirmDelete(event)">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn w-100 btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endsection

    @push('scripts')
        <script>
            // Función para confirmar la eliminación
            function confirmDelete(event) {
                // Muestra el cuadro de confirmación
                if (!confirm('¿Estás seguro de que deseas eliminar este producto?')) {
                    // Si el usuario cancela, previene el envío del formulario
                    event.preventDefault();
                }
            }
        </script>
    @endpush

