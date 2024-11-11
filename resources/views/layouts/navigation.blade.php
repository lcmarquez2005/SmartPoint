<div class="flex justify-end sm:items-center sm:ms-6">
    <x-dropdown align="right" width="48">
        <x-slot name="trigger">
            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                @if(Auth::check())
                    <div>{{ Auth::user()->username }}</div>
                @else
                    <div>Invitado</div> <!-- Opcional: mostrar algo como "Guest" si el usuario no está autenticado -->
                @endif

                <div class="ms-1">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a 1 0 01-1.414 0l-4-4a1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
            </button>
        </x-slot>


        <x-slot name="content">
            @if(Auth::check())
                <x-dropdown-link >
                    {{ __('Profile') }}
                </x-dropdown-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Cerrar Sesion') }}
                    </x-dropdown-link>
                </form>
            @else
                <x-dropdown-link :href="route('login')">
                    {{ __('Inicia Sesion') }}
                </x-dropdown-link>
                <x-dropdown-link :href="route('register')">
                    {{ __('Registrate') }}
                </x-dropdown-link>
            @endif
        </x-slot>
    </x-dropdown>
</div>