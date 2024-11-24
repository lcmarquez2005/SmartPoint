@extends('layouts.app')


@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4">Nueva Venta</h2>
    <!-- Formulario de producto -->
    <div class="card mb-4">
        <form class="card-body" method="POST" action="{{route('detalle.create') }}">
            @csrf
            <div class="row g-2">
                <div class="col-md-2">
                    <label class="form-label">Código:</label>
                    <input name="cod_pro" id="producto_codigo" type="text" class="form-control form-control-sm" value="{{ isset($producto->cod_pro) ? $producto->cod_pro : '' }}">
                </div>
                
                <div class="col-md-6 form-group">
                    <label for="producto_nombre">Producto</label>
                    <select id="producto_nombre" name="nombre" class="form-control">
                        <option value="">Escribe o selecciona un producto</option>
                        @foreach ($productos as $producto)
                            <option value="{{ $producto->cod_pro }}" data-nombre="{{ $producto->nombre }}" data-stock="{{ $producto->cantidad }}">
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
                    <input name="cantidad" type="number" class="form-control form-control-sm" max="{{$producto->cantidad}}">
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
        <table class="table table-hover table-bordered border-dark">
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
                @if (isset($productosSelected))      
                    @foreach ($productosSelected as $selected)
                        <tr>
                            <td>{{ $selected->cod_pro }}</td>
                            <td>{{ $selected->nombre }}</td>
                            <td>{{ $selected->cantidad }}</td>
                            <td>{{ $selected->precio }}</td>
                            <td>
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
    <!-- Información del cliente -->
    <div class="row">
        <div class="col-md-6 form-group">
            <label for="cliente_id">Cliente</label>
            <select id="cliente_id" name="cliente_id" class="form-control" onchange="toggleNewClienteInput(this)">
                <option value="">Seleccione un cliente</option>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                @endforeach
                <option value="0">Agregar Nuevo Cliente + </option>
            </select>
        </div>

        <!-- Información de pago -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title border-bottom pb-2">Pago:</h5>
                    <div class="row g-2">
                        <div class="col-md-6">
                            <label class="form-label">Total A Pagar:</label>
                            <input type="number" class="form-control form-control-sm">
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
                            <select class="form-select form-select-sm">
                                <option value="efectivo">Efectivo</option>
                                <option value="tarjeta">Tarjeta</option>
                            </select>
                        </div>
                    </div>
                    <!-- Botones de acción -->
                    <div class="d-flex justify-content-end gap-2 mt-3">
                        <button class="btn btn-success btn-sm">
                            <i class="bi bi-check-circle"></i> Finalizar Venta
                        </button>
                        <button class="btn btn-danger btn-sm">
                            <i class="bi bi-x-circle"></i> Cancelar Venta
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')

<script>
$(document).ready(function () {
    // Inicializar Select2
    $('#producto_nombre').select2({
        placeholder: "Escriba o seleccione un producto",
        allowClear: true
    });

    // Variables para los campos
    const codigoInput = document.getElementById("producto_codigo");
    const stockInput = document.getElementById("producto_stock");
    const nombreSelect = document.getElementById("producto_nombre");

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
        } else {
            codigoInput.value = "";
            stockInput.value = "";
        }
    });

    // Limpia los campos si el select se limpia
    $(nombreSelect).on("select2:unselect", function () {
        codigoInput.value = "";
        stockInput.value = "";
    });
});


</script>

@endpush