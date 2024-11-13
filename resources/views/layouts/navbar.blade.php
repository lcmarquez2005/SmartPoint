<!-- Barra lateral -->
<div class="sidebar">
    <!-- Perfil usuario -->
    <div class="user-profile">
        <img src="{{ asset('imagenes/icono.jpg') }}" alt="User Profile">
        <div>
            @if(Auth::check())
                {{ Auth::user()->username }}
                <!-- Authentication -->

            @else
                Invitado
            @endif
        </div>
    </div>

    <!-- Menu de navegacion -->
    <ul class="nav-menu">
        <li>
            <a href=""><i class="bi bi-cart-plus"></i> Nueva Venta</a>
        </li>
        <li>
            <a href="{{ route('products.index') }}"><i class="bi bi-box-seam"></i> Productos</a>
        </li>
        <li>
            <a href=""><i class="bi bi-truck"></i> Proveedores</a>
        </li>
        <li>
            <a href=""><i class="bi bi-people"></i> Clientes</a>
        </li>
        <li>
            <a href=""><i class="bi bi-arrow-return-left"></i> Devoluciones</a>
        </li>
        <li>
            <a href=""><i class="bi bi-gear"></i> Gestión</a>
        </li>
        <li>
            <a href="""><i class="bi bi-sliders"></i> Configuración</a>
        </li>
    </ul>
</div>
