@extends('layouts.app')  <!-- Asegúrate de extender tu layout principal -->

@section('content')
<div class="container">
    <h1>Crear Producto</h1>
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nombre del Producto</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="price">Precio</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>
        <button type="submit" class="btn btn-primary">Crear Producto</button>
    </form>
</div>
@endsection
