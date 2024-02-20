<!-- Sección de nav -->
<nav id="mySidenav">
    <section class="header-nav">
        <img src="https://images.assetsdelivery.com/compings_v2/lumut/lumut1511/lumut151100229.jpg" alt="logo">
        <h1><em>Ecommerce</em></li>
    </section>


    <ul>
        <!-- SECCIÓN DE DASHBOARD - PANTALLA PRINCIPAL -->
        <li class="navs-collapsible">
            <a class="colapse-unique-option" href="#dashboard ">
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
                    <a href="#clientes">
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
                <li><a href="#">Categorías</a></li>
                <li><a href="#">Productos</a></li>
                <li><a href="#">Informes</a></li>
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
                <li><a href="#">Pedidos</a></li>
                <li><a href="#">Informes</a></li>
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
                <li><a href="#">Rol</a></li>
                <li><a href="#">Usuarios</a></li>
                <li><a href="#">Informes</a></li>
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
</nav>

<!-- Sección de header -->
<header id="head-content">
    <!-- Botón del menú  -->
    <button id="menu-icon">
        <i class="fa-solid fa-bars"></i>
    </button>

    <!-- Sección del icóno y el botón de expandir -->
    <section class="section-perfiles">
        <img class="perfil"
            src="https://img.freepik.com/fotos-premium/colegial-triste-imagen-3d-fondo-colorido-ai-generativo_58409-28910.jpg?size=338&ext=jpg&ga=GA1.1.1412446893.1705449600&semt=ais"
            alt="perfil">
        <button id="expand-icon">
            <i id="btn-expand" class="fa-solid fa-maximize"></i>
        </button>
    </section>
</header>

<!-- Sección del contenido principal -->
<main id="main-content">
    @yield("content")
</main>