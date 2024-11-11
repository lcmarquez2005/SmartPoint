<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $pageTitle ?? 'Dashboard' }}
        </h2>
    </x-slot>
    

    
    @section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if ($products->isEmpty())
                        <p class="mt-4 text-gray-600 dark:text-gray-300">No products available.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @endsection

</x-app-layout>