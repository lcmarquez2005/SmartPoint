<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $pageTitle ?? 'Dashboard' }}
        </h2>
    </x-slot>
    
    @section('content')
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <div class="dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Listado de Productos</h3>
                    <a href="{{ route('products.create') }}" class="btn btn-primary">Nuevo Producto +</a>
                    
                    <table class="min-w-full dark:bg-gray-800">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b dark:border-gray-700">Codigo</th>
                                <th class="py-2 px-4 border-b dark:border-gray-700">Nombre</th>
                                <th class="py-2 px-4 border-b dark:border-gray-700">Stock</th>
                                <th class="py-2 px-4 border-b dark:border-gray-700">Precio</th>
                                <th class="py-2 px-4 border-b dark:border-gray-700">Min. Recomendado</th>
                                <th class="py-2 px-4 border-b dark:border-gray-700">Max. Recomendado</th>
                                <th class="py-2 px-4 border-b dark:border-gray-700">Piezas</th>
                                <th class="py-2 px-4 border-b dark:border-gray-700">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td class="py-2 px-4 border-b dark:border-gray-700">{{ $product->cod_pro }}</td>
                                    <td class="py-2 px-4 border-b dark:border-gray-700">{{ $product->nombre }}</td>
                                    <td class="py-2 px-4 border-b dark:border-gray-700">{{ number_format($product->cantidad, 2) }}</td>
                                    <td class="py-2 px-4 border-b dark:border-gray-700">${{ number_format($product->precio, 2) }}</td>
                                    <td class="py-2 px-4 border-b dark:border-gray-700">{{ number_format($product->st_minimos, 2) }}</td>
                                    <td class="py-2 px-4 border-b dark:border-gray-700">{{ number_format($product->st_maximos, 2) }}</td>
                                    <td class="py-2 px-4 border-b dark:border-gray-700">{{ number_format($product->piezas, 2) }}</td>
                                    <td class="py-2 px-4 border-b dark:border-gray-700">
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

                    @if ($products->isEmpty())
                        <p class="mt-4 text-gray-600 dark:text-gray-300">No hay productos disponibles.</p>
                    @endif
                </div>
            </div>
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
</x-app-layout>
