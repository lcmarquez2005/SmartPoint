@php
switch ($type) {
case 2:
$col = 'col-md-6'; break; // 2 columnas
case 3:
$col = 'col-md-4'; break; // 3 columnas
case 4:
$col = 'col-md-3'; break; // 4 columnas
case 1:
default:
$col = ''; // Vertical sin grid
}
@endphp

<form action="{{ $action }}" method="POST" class="mb-4">
    @csrf

    <div class="row">
        <div class="{{ $col }}">
            <label for="cod_pro">Código de Producto</label>
            <input type="text" class="form-control" name="cod_pro" id="cod_pro" required maxlength="50">
        </div>
        <div class="{{ $col }}">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" name="nombre" id="nombre" required maxlength="45">
        </div>
        <div class="{{ $col }}">
            <label for="cantidad">Cantidad</label>
            <input type="number" step="0.01" class="form-control" name="cantidad" id="cantidad" required>
        </div>
        <div class="{{ $col }}">
            <label for="precio">Precio</label>
            <input type="number" step="0.01" class="form-control" name="precio" id="precio" required>
        </div>
        <div class="{{ $col }}">
            <label for="st_minimos">Stock Mínimo</label>
            <input type="number" step="0.01" class="form-control" name="st_minimos" id="st_minimos">
        </div>
        <div class="{{ $col }}">
            <label for="st_maximos">Stock Máximo</label>
            <input type="number" step="0.01" class="form-control" name="st_maximos" id="st_maximos">
        </div>
        <div class="{{ $col }}">
            <label for="piezas">Piezas</label>
            <input type="number" class="form-control" name="piezas" id="piezas">
        </div>
        <div class="{{ $col }} d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Guardar Producto</button>
        </div>
    </div>

</form>
