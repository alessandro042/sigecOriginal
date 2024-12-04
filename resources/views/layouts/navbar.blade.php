<nav class="navbar navbar-expand-md navbar-light nav shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">Inicio</a>
                </li>

                @if (Auth::check())
                    <!-- Matrícula -->
                    @if (Auth::user()->hasRol('Administrador') || Auth::user()->hasRol('Editor') || Auth::user()->hasRol('Consultor'))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink1" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Matrícula
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink1">
                                <li><a class="dropdown-item" href="">General</a></li>
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle" href="#">Igualdad</a>
                                    <ul class="dropdown-menu">
                                        @if (Auth::user()->hasRol('Administrador') || Auth::user()->hasRol('Editor'))
                                            <li><a class="dropdown-item" href="{{ route('matricula.igualdad-genero.index') }}">Gestión</a></li>
                                        @endif
                                        @if (Auth::user()->hasRol('Consultor') || Auth::user()->hasRol('Administrador'))
                                            <li><a class="dropdown-item" href="{{ route('matricula.igualdad-genero.report') }}">Reporte</a></li>
                                        @endif
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle" href="#">Inclusión</a>
                                    <ul class="dropdown-menu">
                                        @if (Auth::user()->hasRol('Administrador') || Auth::user()->hasRol('Editor'))
                                            <li><a class="dropdown-item" href="{{ route('matricula.inclusion.index') }}">Gestión</a></li>
                                        @endif
                                        @if (Auth::user()->hasRol('Consultor') || Auth::user()->hasRol('Administrador'))
                                            <li><a class="dropdown-item" href="{{ route('matricula.inclusion.report') }}">Reporte</a></li>
                                        @endif
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle" href="#">Interculturalidad</a>
                                    <ul class="dropdown-menu">
                                        @if (Auth::user()->hasRol('Administrador') || Auth::user()->hasRol('Editor'))
                                            <li><a class="dropdown-item" href="{{ route('matricula.interculturalidad.index') }}">Gestión</a></li>
                                        @endif
                                        @if (Auth::user()->hasRol('Consultor') || Auth::user()->hasRol('Administrador'))
                                            <li><a class="dropdown-item" href="{{ route('matricula.interculturalidad.report') }}">Reporte</a></li>
                                        @endif
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    @endif

                    <!-- Seguimiento de Trayectoria -->
                    @if (Auth::user()->hasRol('Administrador') || Auth::user()->hasRol('Editor') || Auth::user()->hasRol('Consultor'))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink3" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Seguimiento de Trayectoria
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink3">
                                @if (Auth::user()->hasRol('Administrador') || Auth::user()->hasRol('Editor'))
                                    <li><a class="dropdown-item" href="{{ route('seguimiento-trayectoria.index') }}">index</a></li>
                                    <li><a class="dropdown-item" href="{{ route('seguimiento-trayectoria.create') }}">create</a></li>
                                    <li><a class="dropdown-item" href="{{ route('seguimiento-trayectoria.edit') }}">edit</a></li>
                                @endif
                                @if (Auth::user()->hasRol('Consultor'))
                                    <li><a class="dropdown-item" href="{{ route('seguimiento-trayectoria.report') }}">Reporte</a></li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    <!-- Capacidad Docente -->
                    @if (Auth::user()->hasRol('Administrador') || Auth::user()->hasRol('Editor') || Auth::user()->hasRol('Consultor'))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink4" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Capacidad Docente
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink4">
                                @if (Auth::user()->hasRol('Administrador') || Auth::user()->hasRol('Editor'))
                                    <li><a class="dropdown-item" href="{{ route('capacidad.index') }}">index</a></li>
                                    <li><a class="dropdown-item" href="{{ route('capacidad.create') }}">create</a></li>
                                    <li><a class="dropdown-item" href="{{ route('capacidad.edit') }}">edit</a></li>
                                @endif
                                @if (Auth::user()->hasRol('Consultor'))
                                    <li><a class="dropdown-item" href="{{ route('capacidad.report') }}">Reporte</a></li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    <!-- Competitividad -->
                    @if (Auth::user()->hasRol('Administrador') || Auth::user()->hasRol('Editor') || Auth::user()->hasRol('Consultor'))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink5" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Competitividad
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink5">
                                @if (Auth::user()->hasRol('Administrador') || Auth::user()->hasRol('Editor'))
                                    <li><a class="dropdown-item" href="{{ route('competitividad.index') }}">index</a></li>
                                    <li><a class="dropdown-item" href="{{ route('competitividad.create') }}">create</a></li>
                                    <li><a class="dropdown-item" href="{{ route('competitividad.edit') }}">edit</a></li>
                                @endif
                                @if (Auth::user()->hasRol('Consultor'))
                                    <li><a class="dropdown-item" href="{{ route('competitividad.report') }}">Reporte</a></li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    <!-- Administración -->
                    @if (Auth::user()->hasRol('Administrador'))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink6"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Administración
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink6">
                                <li><a class="dropdown-item" href="{{ route('usuarios.index') }}">Usuarios</a></li>
                                <li><a class="dropdown-item" href="{{ route('proveedores.index') }}">Proveedores</a></li>
                                <li><a class="dropdown-item" href="{{ route('productos.index') }}">Productos</a></li>
                                <li><a class="dropdown-item" href="{{ route('ventas.index') }}">Ventas</a></li>
                                <li><a class="dropdown-item" href="{{ route('ventas.create') }}">Ventas create</a></li>
                                <li><a class="dropdown-item" href="{{ route('corte_caja.index') }}">Corte de caja</a></li>
                            </ul>
                        </li>
                    @elseif (Auth::user()->hasRol('Editor'))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink7"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Administración
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink7">
                                <li><a class="dropdown-item" href="{{ route('programas-educativos.index') }}">Programa Educativo</a></li>
                            </ul>
                        </li>
                    @endif
                @endif
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#" aria-disabled="true"
                                style="pointer-events: none; opacity: 0.6;">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->nombre_completo }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var dropdowns = document.querySelectorAll('.dropdown-submenu');

        dropdowns.forEach(function(dropdown) {
            dropdown.addEventListener('mouseover', function() {
                var submenu = this.querySelector('.dropdown-menu');
                if (submenu) {
                    submenu.classList.add('show');
                }
            });

            dropdown.addEventListener('mouseout', function() {
                var submenu = this.querySelector('.dropdown-menu');
                if (submenu) {
                    submenu.classList.remove('show');
                }
            });
        });
    });
</script>