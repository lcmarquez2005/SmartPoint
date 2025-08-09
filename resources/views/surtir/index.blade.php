@extends('layouts.app')


@section('content')
<div class="container">

    <!-- Contenedor para título y formulario -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-start mb-0">Nuevo Surtido</h2> <!-- Título a la izquierda -->

        <!-- Formulario para vaciar productos seleccionados (botón a la derecha) -->
        <form action="{{ route('vaciar.productos') }}" method="POST">
            <a href="{{route('ventas.index')}}" class="btn btn-success">
                <i class="bi bi-bag"></i> Ver Surtidos
            </a>
            @csrf
            <button type="submit" class="btn btn-danger">
                <i class="bi bi-trash"></i> Vaciar Carrito
            </button>
        </form>
    </div>
    <h4>Crea un Producto:</h4>
    <x-product-form :action="route('products.store')" :type="4" />



    <!-- Formulario de producto -->
    <div class="card mb-4">
        <form class="card-body" method="POST" action="{{route('detalle.create') }}">
            @csrf
            <div class="row g-2">
                <div class="col-md-2">
                    <label class="form-label">Código:</label>
                    <input name="cod_pro" id="producto_codigo" type="text" class="form-control form-control-sm"
                        value="{{ isset($producto->cod_pro) ? $producto->cod_pro : '' }}" autofocus>
                </div>

                <div class="col-md-6 form-group">
                    <label class="form-label" for="producto_nombre">Producto</label>
                    <select id="producto_nombre" name="nombre" class="form-control">
                        <option value="">Escribe o selecciona un producto</option>
                        @foreach ($productos as $producto)
                        <option value="{{ $producto->cod_pro }}" data-nombre="{{ $producto->nombre }}"
                            data-stock="{{ $producto->cantidad }}">
                            {{ $producto->nombre }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-1">
                    <label class="form-label">Stock:</label>
                    <div class="input-group">
                        <input id="producto_stock" type="number" class="form-control form-control-sm" disabled>
                    </div>
                </div>
                {{-- <div class="col-md-1 justify-content-center align-items-end d-flex">
                    <button class="btn btn-success border  btn-sm p-3">
                        <i class="bi bi-search h5"></i>
                    </button>
                </div> --}}

                <div class="col-md-1">
                    <label class="form-label d-block">Cantidad:</label>
                    <input id="producto_cantidad" name="cantidad" type="number" class="form-control form-control-sm"
                        value="1" min="1">
                </div>
                <div class="col-md-1 justify-content-center align-items-end d-flex">
                    <button type="submit" class="btn btn-light border  btn-sm p-3">
                        <i class="bi bi-plus-circle h5"></i>
                    </button>
                </div>
                {{-- <div class="col-md-1 mx-0 justify-content-center align-items-end d-flex">
                    <button class="btn btn-danger border  btn-sm p-3">
                        <i class="bi bi-trash h5"></i>
                    </button>
                </div> --}}

            </div>
        </form>

    </div>

    <!-- Tabla de productos -->
    <div class="table-responsive">
        <table class="table table-hover table-bordered border-dark ">
            <thead>
                <tr>
                    <th scope="col" class="border">Código Producto</th>
                    <th scope="col" class="border">Nombre</th>
                    <th scope="col" class="border">Cantidad</th>
                    <th scope="col" class="border">Precio</th>
                    <th scope="col" class="border">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </div>
                @endif

                @if (isset($productosSelected))
                @foreach ($productosSelected as $selected)
                <tr>
                    <td class="col-2">{{ $selected->cod_pro }}</td>
                    <td class="col-3">{{ $selected->nombre }}</td>
                    <td class="col-1">{{ $selected->cantidad }}</td>
                    <td class="col-2">{{ $selected->precio }}</td>
                    <td class="col-1">
                        <!-- Botón para eliminar -->
                        <form action="{{ route('producto.remove', $selected->cod_pro) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i> Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>

    </div>
    <form action="{{route('ventas.store')}}" method="POST" class="row">
        @csrf
        <!-- Información del Proveedor -->
        {{-- @NahumAgp: aqui deberiamos generar el formulario del cliente cuando seleccione agregar cliente --}}
        <div class="col-md-6">
            <div class="card">

                <div class="card-body row g-2">


                    <div class="col-md-3">

                        <h3 for="proveedor_id">Agregar Proveedor</h3>
                    </div>
                    <div class="col-md-9">

                        <select id="proveedor_id" name="proveedor_id" class="form-control"
                            onchange="toggleNewProveedorInput(this)">

                            <option value="">Seleccione un Proveedor +</option>
                            @foreach ($proveedores as $proveedor)
                            <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }} - {{ $proveedor->telefono }}
                            </option>
                            @endforeach
                            <option value="0">Agregar Nuevo Proveedor + </option>
                        </select>
                    </div>

                </div>
            </div>
        </div>

        <!-- Información de pago -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">

                    <h4>Total a Pagar: <span id="total-pagar">${{ number_format(50, 2) }}</span></h4>

                    <!-- <h4>Total a Pagar: <span id="total-pagar">$//number_format($total, 2) </span></h4> -->

                    <div class="row g-2">
                        <div class="col-md-6">
                            <label class="form-label">Total A Pagar:</label>
                            <input type="number" class="form-control form-control-sm" value="{{50 }}" disabled>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Entrada:</label>
                            <input type="number" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Cambio:</label>
                            <input type="number" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Método de pago:</label>
                            <select name="metodo_pago" class="form-select form-select-sm">
                                <option value="">Seleccione un Metodo Pago</option>
                                <option value="Efectivo">Efectivo</option>
                                <option value="Tarjeta">Tarjeta</option>
                            </select>
                        </div>
                    </div>

                    @foreach (session('productosSelected', []) as $producto)
                    <input type="hidden" name="productos[{{ $producto->cod_pro }}][cod_pro]"
                        value="{{ $producto->cod_pro }}">
                    <input type="hidden" name="productos[{{ $producto->cod_pro }}][cantidad]"
                        value="{{ $producto->cantidad }}">
                    @endforeach

                    <!-- Botones de acción -->
                    <div class="d-flex justify-content-end gap-2 mt-3">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle"></i> Finalizar Venta
                        </button>
                        {{-- <a href="{{route('products.index')}}" class="btn btn-danger btn-sm">
                            <i class="bi bi-x-circle"></i> Cancelar Venta
                        </a> --}}
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection
@push('scripts')

<script>
    $(document).ready(function () {
        // Inicializar Select2
        $('#producto_nombre').select2({
            placeholder: "Escriba o seleccione un producto",
            allowClear: true,
        });

        // Variables para los campos
        const codigoInput = document.getElementById("producto_codigo");
        const stockInput = document.getElementById("producto_stock");
        const nombreSelect = document.getElementById("producto_nombre");
        const cantidadInput = document.getElementById("producto_cantidad");

        // Sincroniza cuando se cambia el código manualmente
        codigoInput.addEventListener("input", function () {
            const codigo = this.value.trim();

            // Busca la opción correspondiente en el select por el valor (código del producto)
            const opcion = Array.from(nombreSelect.options).find(opt => opt.value === codigo);

            if (opcion) {
                $(nombreSelect).val(codigo).trigger('change'); // Cambia el valor del select y dispara el evento de Select2
                stockInput.value = opcion.dataset.stock || ""; // Asigna el stock correspondiente
            } else {
                $(nombreSelect).val("").trigger('change'); // Limpia si no coincide
                stockInput.value = ""; // Limpia el campo de stock
            }
        });

        // Sincroniza cuando se selecciona o escribe en el select
        $(nombreSelect).on("select2:select", function (e) {
            const selectedOption = e.params.data.element; // Elemento HTML de la opción seleccionada
            const stock = selectedOption.dataset.stock; // Stock del producto seleccionado
            const codigo = selectedOption.value; // Código del producto seleccionado

            // Asigna los valores correspondientes
            if (codigo) {
                codigoInput.value = codigo;
                stockInput.value = stock || ""; // Asigna el stock o deja vacío si no hay

                // Actualiza el max del campo cantidad
                if (stock && !isNaN(stock)) {
                    cantidadInput.setAttribute("max", stock); // Establece el valor máximo del input de cantidad
                    cantidadInput.setAttribute("min", 1); // Asegura que el mínimo sea 1
                } else {
                    cantidadInput.setAttribute("max", 1); // Si no hay stock, limita el valor máximo a 1
                }
            } else {
                codigoInput.value = "";
                stockInput.value = "";

                // Si no se selecciona un producto, limpia los campos relacionados
                cantidadInput.setAttribute("max", 1); // Limita el valor máximo de cantidad
                cantidadInput.setAttribute("min", 1); // Limita el mínimo a 1
            }
        });

        // Limpia los campos si el select se limpia
        $(nombreSelect).on("select2:unselect", function () {
            codigoInput.value = "";
            stockInput.value = "";
            cantidadInput.setAttribute("max", 1); // Limita el máximo
            cantidadInput.setAttribute("min", 1); // Limita el mínimo
        });
    });





</script>

@endpush
