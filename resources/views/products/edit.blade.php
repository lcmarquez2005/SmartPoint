@extends('layouts.app')

@section('content')
    <div class="container w-50">
        <h2>Editar Producto</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif


        <form action="{{ route('products.update', $product->cod_pro) }}" method="POST">
            @csrf
            @method('PUT') <!-- Para indicar que esta es una solicitud de actualización -->

            <div class="form-group">
                <label hidden for="cod_pro">Código del Producto:</label>
                <input type="text" name="cod_pro" class="form-control" value="{{ old('cod_pro', $product->cod_pro) }}" required hidden>
            </div>

            <div class="form-group">
                <label for="nombre">Nombre del Producto:</label>
                <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $product->nombre) }}" required>
            </div>

            <div class="form-group">
                <label for="cantidad">Cantidad:</label>
                <input type="number" name="cantidad" class="form-control" value="{{ old('cantidad', $product->cantidad) }}" required>
            </div>

            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="number" name="precio" class="form-control" value="{{ old('precio', $product->precio) }}" required>
            </div>

            <div class="form-group">
                <label for="st_minimos">Stock Mínimo:</label>
                <input type="number" name="st_minimos" class="form-control" value="{{ old('st_minimos', $product->st_minimos) }}">
            </div>

            <div class="form-group">
                <label for="st_maximos">Stock Máximo:</label>
                <input type="number" name="st_maximos" class="form-control" value="{{ old('st_maximos', $product->st_maximos) }}">
            </div>

            <div class="form-group">
                <label for="piezas">Piezas:</label>
                <input type="number" name="piezas" class="form-control" value="{{ old('piezas', $product->piezas) }}">
            </div>

            <button type="submit" class="btn btn-primary">Actualizar Producto</button>
        </form>
    </div>
@endsection
