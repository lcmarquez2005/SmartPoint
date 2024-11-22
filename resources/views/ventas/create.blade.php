


@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4">Nueva Venta</h2>
    <!-- Formulario de producto -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-2">
                    <label class="form-label">Código:</label>
                    <input type="text" class="form-control form-control-sm">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Descripción:</label>
                    <input type="text" class="form-control form-control-sm">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Cantidad:</label>
                    <input type="number" class="form-control form-control-sm">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Precio:</label>
                    <input type="number" class="form-control form-control-sm">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Stock Disponible:</label>
                    <div class="input-group">
                        <input type="number" class="form-control form-control-sm">
                        <button class="btn btn-danger btn-sm">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de productos -->
    <div class="table-responsive">
        <table class="table table-hover table-bordered border-dark">
            <thead>
                <tr>
                    <th scope="col" class="border">Nombre</th>
                    <th scope="col" class="border">Cantidad</th>
                    <th scope="col" class="border">Precio</th>
                    <th scope="col" class="border">Stock minimo</th>
                    <th scope="col" class="border">Stock maximo</th>
                    <th scope="col" class="border">Piezas</th>
                </tr>
            </thead>
        
        </table>
    </div>
    <!-- Información del cliente -->
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title border-bottom pb-2">Cliente:</h5>
                    <div class="row g-2">
                        <div class="col-md-6">
                            <label class="form-label">Nombre:</label>
                            <input type="text" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Teléfono:</label>
                            <input type="tel" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Dirección:</label>
                            <input type="text" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Razón social:</label>
                            <input type="text" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Pago pendiente:</label>
                            <input type="number" class="form-control form-control-sm">
                        </div>
                    </div>
                </div>
            </div>
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