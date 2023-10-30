<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('dist/img/pnc.jfif') }}" alt="HPNC" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">HPNC
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block">
                    {{ auth()->user()->email }}

                    @if (auth()->user()->rol == 1)
                        <p>Administrador</p>
                    @elseif(auth()->user()->rol == 2)
                        <p>Ingreso</p>
                    @else
                        <p>Egreso</p>
                    @endif
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                @if (auth()->user()->rol == '1')
                    <li class="nav-item menu-open">
                        <a href="{{ url('/') }}" class="nav-link active">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-header text-danger"><strong>GESTIONAR</strong></li>
                    <li class="nav-item">
                        <a href="#!" class="nav-link text-success"
                            onclick="cargar_contenido('contenido_principal', '{{ url('crearusuario') }}')">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Usuarios
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#!" class="nav-link text-primary"
                            onclick="cargar_contenido('contenido_principal', '{{ url('categorias') }}')">
                            <i class="nav-icon fas fa-grip-vertical"></i>
                            <p>
                                Categorías
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#!" class="nav-link text-black"
                            onclick="cargar_contenido('contenido_principal', '{{ url('items') }}')">
                            <i class="nav-icon fas fa-sitemap"></i>
                            <p>
                                Items
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#!" class="nav-link text-yellow"
                            onclick="cargar_contenido('contenido_principal', '{{ url('usuarios') }}')">
                            <i class="nav-icon fas fa-fw fa-user"></i>
                            <p>
                                Afiliados
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#!" class="nav-link text-green"
                            onclick="cargar_contenido('contenido_principal', '{{ url('pacientes') }}')">
                            <i class="nav-icon fas fa-procedures"></i>
                            <p>
                                Pacientes
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#!" class="nav-link text-info"
                            onclick="cargar_contenido('contenido_principal', '{{ url('colaboradores') }}')">
                            <i class="nav-icon fas fa-people-carry"></i>
                            <p>
                                Colaboradores
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#!" class="nav-link"
                            onclick="cargar_contenido('contenido_principal', '{{ url('productos') }}')">
                            <i class="nav-icon fas fa-hospital"></i>
                            <p>
                                Productos
                            </p>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->rol == '2' || auth()->user()->rol == '1')
                    <li class="nav-item">
                        <a href="#!" class="nav-link"
                            onclick="cargar_contenido('contenido_principal', '{{ url('bodega') }}')">
                            <i class="nav-icon fas fa-warehouse"></i>
                            <p>
                                Ingreso a bodega
                            </p>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->rol == '3' || auth()->user()->rol == '1')
                    <li class="nav-item">
                        <a href="#!" class="nav-link"
                            onclick="cargar_contenido('contenido_principal', '{{ url('egresobodega') }}')">
                            <i class="nav-icon fas fa-cart-plus"></i>
                            <p>
                                Despacho de bodega
                            </p>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Cerrar sesión</button>
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
