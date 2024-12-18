@extends('layouts.app')

@section('content')
<a href="{{route('products.index')}}" class="btn btn-danger">
    <i class="bi bi-arrow-return-left"></i> Volver
</a>
<div class="container w-50">
    <h2>Crear Producto</h2>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="cod_pro">Código de Producto</label>
            <input type="text" class="form-control" name="cod_pro" id="cod_pro" required maxlength="50">
        </div>
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" name="nombre" id="nombre" required maxlength="45">
        </div>
        <div class="form-group">
            <label for="cantidad">Cantidad</label>
            <input type="number" step="0.01" class="form-control" name="cantidad" id="cantidad" required>
        </div>
        <div class="form-group">
            <label for="precio">Precio</label>
            <input type="number" step="0.01" class="form-control" name="precio" id="precio" required>
        </div>
        <div class="form-group">
            <label for="st_minimos">Stock Mínimo</label>
            <input type="number" step="0.01" class="form-control" name="st_minimos" id="st_minimos">
        </div>
        <div class="form-group">
            <label for="st_maximos">Stock Máximo</label>
            <input type="number" step="0.01" class="form-control" name="st_maximos" id="st_maximos">
        </div>
        <div class="form-group">
            <label for="piezas">Piezas</label>
            <input type="number" class="form-control" name="piezas" id="piezas">
        </div>
        <button type="submit" class="btn btn-primary">Guardar Producto</button>
    </form>
</div>
@endsection
