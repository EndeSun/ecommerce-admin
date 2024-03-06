<!-- Sección de nav -->
@guest
    <nav id="sidenav-guest">
    @else
        <nav id="mySidenav">
        @endguest

        @guest
        @else
            <section class="header-nav">
                <img class="w-25 h-25" src="https://images.assetsdelivery.com/compings_v2/lumut/lumut1511/lumut151100229.jpg"
                    alt="logo">
                <h1><em>Ecommerce</em></li>
            </section>
            <ul>
                <!-- SECCIÓN DE DASHBOARD - PANTALLA PRINCIPAL -->
                <li class="navs-collapsible">
                    <a class="colapse-unique-option" href="/dashboard ">
                        <i class="fa-brands fa-screenpal"></i>
                        <span class="txtLink">Dashboard</span>
                    </a>
                </li>
                <hr />

                <!-- ------- -->
                <!-- SECCIÓN DE CLIENTES -->
                <li class="navs-collapsible">
                    <div class="icon-text-chevron-container">
                        <div class="icon-text">
                            <a href="/clientes">
                                <i class="fa-solid fa-user-tag"></i>
                                <span class="txtLink">Clientes</span>
                            </a>
                        </div>
                    </div>
                </li>
                <hr>

                <!-- ------- -->
                <!-- SEECIÓN DE GESTIÓN DE PRODUCTOS -->
                <li class="navs-collapsible">
                    <div class="icon-text-chevron-container">
                        <div class="icon-text">
                            <i class="fa-brands fa-product-hunt"></i>
                            <span class="txtLink">Gestión productos</span>
                        </div>
                        <i class="fa-solid fa-chevron-right chevron"></i>
                    </div>

                    <ul class="sublist-container hidden">
                        <li><a href="/categorias">Categorías</a></li>
                        <li><a href="/productos">Productos</a></li>
                        <li><a href="/productos/informes">Informes</a></li>
                    </ul>
                </li>
                <hr>

                <!-- ------- -->
                <!-- SECCIÓN DE GESTIÓN DE PEDIDOS -->
                <li class="navs-collapsible">
                    <div class="icon-text-chevron-container">
                        <div class="icon-text">
                            <i class="fa-solid fa-truck"></i>
                            <span class="txtLink">Gestión pedidos</span>
                        </div>
                        <i class="fa-solid fa-chevron-right chevron"></i>
                    </div>

                    <ul class="sublist-container hidden">
                        <li><a href="/pedidos">Pedidos</a></li>
                        <li><a href="/pedidos/informes">Informes</a></li>
                    </ul>
                </li>
                <hr>

                <!-- ------- -->
                <!-- SECCIÓN DE GESTIÓN DE USUARIOS -->
                <li class="navs-collapsible">
                    <div class="icon-text-chevron-container">
                        <div class="icon-text">
                            <i class="fa-solid fa-user-group"></i>
                            <span class="txtLink">Gestión usuarios</span>
                        </div>
                        <i class="fa-solid fa-chevron-right chevron"></i>
                    </div>

                    <ul class="sublist-container hidden">
                        <li><a href="/rol">Rol</a></li>
                        <li><a href="/usuarios">Usuarios</a></li>
                        <li><a href="/usuarios/informes">Informes</a></li>
                    </ul>
                </li>
                <hr>
                <!-- ------- -->
                <!-- Sección de configuraciones -->
                <li class="navs-collapsible">
                    <div class="icon-text-chevron-container">
                        <div class="icon-text">
                            <i class="fa-solid fa-gear"></i>
                            <span class="txtLink">Configuraciones</span>
                        </div>
                        <i class="fa-solid fa-chevron-right chevron"></i>
                    </div>

                    <ul class="sublist-container hidden">
                        <li><a href="#">Configuración 1</a></li>
                        <li><a href="#">Configuración 1</a></li>
                        <li><a href="#">Configuración 1</a></li>
                    </ul>
                </li>
            </ul>
        @endguest
    </nav>



    <!-- Sección de header -->
    @guest
        <header id="head-guest">
        @else
            <header id="head-content">
            @endguest
            <!-- Botón del menú  -->
            @guest
                <section>
                    <img id="logo-img"
                        src="https://images.assetsdelivery.com/compings_v2/lumut/lumut1511/lumut151100229.jpg"
                        alt="logo">
                </section>
            @else
                <button id="menu-icon">
                    <i class="fa-solid fa-bars"></i>
                </button>
            @endguest

            <!-- Sección del icóno y el botón de expandir -->
            <section id="section-perfiles" class="section-perfiles dropdown">
                @guest
                    <img class="perfil dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"
                        src="https://static.vecteezy.com/system/resources/thumbnails/002/318/271/small/user-profile-icon-free-vector.jpg"
                        alt="perfil">
                @else
                    <img class="perfil dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"
                        src="{{ Auth::user()->image }}" alt="perfil">
                @endguest


                <button id="expand-icon">
                    <i id="btn-expand" class="fa-solid fa-maximize"></i>
                </button>

                <ul class="dropdown-menu dropdown-menu-dark">
                    @guest
                        @if (Route::has('login'))
                            <li class="dropdown-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="dropdown-item">
                                <a class="nav-link" href="{{ route('register') }}">Registrar</a>
                            </li>
                        @endif
                    @else
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                                Cambiar de usuario
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                                Cerrar sesión
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    @endguest
                </ul>
            </section>
        </header>

        <!-- Sección del contenido principal -->
        @guest
            <main>
            @else
                <main id="main-content">
                @endguest
                @yield('content')
            </main>
