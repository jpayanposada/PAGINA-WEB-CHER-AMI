<?php
require_once 'controller/session_manager.php';
iniciar_sesion();

// Obtener el nombre del archivo actual
$current_page = basename($_SERVER['PHP_SELF']);

// Agregar al inicio del archivo después del session_start()
echo "<script>
    console.log('Sesión foto_perfil: " . ($_SESSION['foto_perfil'] ?? 'no definida') . "');
    console.log('Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "');
    console.log('Script Filename: " . $_SERVER['SCRIPT_FILENAME'] . "');
</script>";
error_log('Sesión actual: ' . print_r($_SESSION, true));
error_log('Foto de perfil en sesión: ' . ($_SESSION['foto_perfil'] ?? 'no definida'));
?>

<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico?v=<?php echo time(); ?>">

<header style="background-color:rgb(240, 240, 240); position: sticky; top: 0; z-index: 1030;">
    <div class="header-area header-transparent"></div>
    <div class="header-top header-sticky">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-2 d-flex align-items-center">
                    <!-- Botón para abrir el sidebar/offcanvas -->
                    <a class="btn-perfil me-5" data-bs-toggle="offcanvas" href="#sidebarMenu" role="button" aria-controls="sidebarMenu" style="font-size: 2rem;">
                        <i class="bi bi-list text-black"></i>
                    </a>

                    <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel" data-bs-backdrop="false" data-bs-scroll="true">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="sidebarMenuLabel">Menú</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <div class="row g-2" style="justify-content: flex-start; padding-left: 20px;">
                                <!-- Primera fila: botones 1 y 2 -->
                                <div class="col-6">
                                    <!-- Dashboard (1) -->
                                    <a href="#" class="btn btn-primary d-flex flex-column justify-content-center align-items-center sidebar-btn" onclick="mostrarSeccion('dashboard'); return false;" style="width: 120px; height: 100px;">
                                        <i class="fas fa-tachometer-alt mb-2"></i>
                                        <span>Dashboard</span>
                                    </a>
                                </div>
                                <div class="col-6">
                                    <!-- Categorias (2) -->
                                    <a href="#" class="btn btn-primary d-flex flex-column justify-content-center align-items-center sidebar-btn" onclick="mostrarSeccion('ofertas'); return false;" style="width: 120px; height: 100px;">
                                        <i class="fas fa-briefcase mb-2"></i>
                                        <span>Categorias</span>
                                    </a>
                                </div>

                                <!-- Segunda fila: botones 3 y 4 -->

                                <div class="col-6">
                                    <!-- Feria (3) -->
                                    <a href="#" class="btn btn-primary d-flex flex-column justify-content-center align-items-center sidebar-btn" onclick="mostrarSeccion('feria'); return false;" style="width: 120px; height: 100px;">
                                        <i class="bi bi-calendar2-event-fill mb-2"></i>
                                        <span>Publicaciones</span>
                                    </a>
                                </div>

                                <div class="col-6">
                                    <!-- Perfil (4) -->
                                    <a href="#" class="btn btn-primary d-flex flex-column justify-content-center align-items-center sidebar-btn" onclick="mostrarSeccion('perfil'); return false;" style="width: 120px; height: 100px;">
                                        <i class="fas fa-user-circle mb-2"></i>
                                        <span>Perfil</span>
                                    </a>
                                </div>

                                <div class="col-6">
                                    <!-- Contraseña (5) -->
                                    <button class="btn btn-primary d-flex flex-column justify-content-center align-items-center sidebar-btn" data-bs-toggle="modal" data-bs-target="#modalCambiarContrasena" style="width: 120px; height: 100px;">
                                        <i class="fas fa-key mb-2"></i>
                                        <span>Contraseña</span>
                                    </button>
                                </div>
                                <div class="col-6">
                                    <!-- Celda vacía para mantener simetría -->
                                </div>

                                <!-- Separador -->
                                <div class="col-12">
                                    <hr class="my-2">
                                </div>

                                <!-- Cerrar Sesión en fila completa -->
                                <div class="col-12 d-flex justify-content-start">
                                    <a href="controller/logout.php" class="btn btn-danger d-flex flex-column justify-content-center align-items-center sidebar-btn-full" style="height: 60px; width: 85%;">
                                        <i class="fas fa-sign-out-alt mb-2"></i>
                                        <span>Cerrar Sesión</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Logo -->
                    <div class="logo_sige">
                        <a href="#" onclick="mostrarSeccion('dashboard'); return false;"><img src="img/logo_sige.png" alt="" style="width: 60%; height: auto;"></a>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 d-flex justify-content-end">
                    <div class="menu-wrapper d-flex justify-content-end">
                        <!-- Main-menu -->
                        <div class="main-menu">
                            <nav class="d-none d-lg-block">
                                <ul id="navigation">
                                </ul>
                            </nav>
                        </div>
                        <!-- Header-btn movido al final -->
                        <div class="header-btn d-none d-lg-block ms-auto">
                            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']): ?>
                                <div class="dropdown">
                                    <button class="btn dropdown-toggle d-flex align-items-center"
                                        type="button"
                                        id="userMenu"
                                        data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <img src="<?php
                                                    $foto = $_SESSION['foto_perfil'] ?? 'default.jpg';
                                                    $ruta_img = '/uploads/profilePics/' . $foto;
                                                    $ruta_servidor = $_SERVER['DOCUMENT_ROOT'] . $ruta_img;

                                                    if (!file_exists($ruta_servidor)) {
                                                        $ruta_img = '/img/default-avatar.jpg';
                                                    }
                                                    echo htmlspecialchars($ruta_img);
                                                    ?>"
                                            alt="Foto de perfil"
                                            class="rounded-circle"
                                            style="width: 45px; height: 45px; object-fit: cover;">
                                        <span class="ms-2" style="color: #2c3e50;"><?php echo htmlspecialchars($_SESSION['nombre']); ?></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                                        <li>
                                            <a class="dropdown-item" href="#" onclick="mostrarSeccion('perfil'); return false;">
                                                <i class="fas fa-user me-2"></i> Mi Perfil
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalCambiarContrasena">
                                                <i class="fas fa-key me-2"></i> Cambiar Contraseña
                                            </a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <a class="dropdown-item text-danger" href="controller/logout.php">
                                                <i class="fas fa-sign-out-alt me-2"></i> Cerrar Sesión
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- Mobile Menu -->
                <div class="col-12">
                    <div class="mobile_menu d-block d-lg-none"></div>
                </div>
            </div>
        </div>
    </div>
</header>

<style>
    .dropdown-toggle::after {
        display: inline-block;
        margin-left: 0.5em;
        vertical-align: middle;
    }

    .dropdown-menu {
        min-width: 200px;
        padding: 0.5rem 0;
        margin-top: 0.5rem;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }

    .dropdown-item {
        padding: 0.5rem 1rem;
        display: flex;
        align-items: center;
    }

    .dropdown-item:hover {
        background-color: #f8f9fa;
    }

    .btn.dropdown-toggle {
        background: transparent;
        border: none;
        padding: 0.5rem 1rem;
    }

    .btn.dropdown-toggle:focus {
        box-shadow: none;
    }

    .header-btn .dropdown-toggle img {
        width: 45px !important;
        /* Aumentar tamaño de imagen */
        height: 45px !important;
        border: 2px solid rgb(207, 120, 120);
        transition: all 0.3s ease;
    }

    /* Efecto hover en la imagen */
    .header-btn .dropdown-toggle img:hover {
        transform: scale(1.05);
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    /* Estilo para el nombre de usuario */
    .header-btn .dropdown-toggle span {
        font-size: 1.1rem;
        font-weight: 500;
        margin-left: 12px !important;
    }

    .nav-link {
        background: none;
        border: none;
        text-align: left;
        width: 100%;
        cursor: pointer;
        color: white;
    }

    .sidebar {
        background-color: #30336b;
        /* Puedes cambiar este color por el que prefieras */
        min-height: 100vh;
    }

    .nav-link:hover,
    .nav-link.active {
        background-color: rgba(255, 255, 255, 0.1);
    }

    #sidebarMenu .btn-primary {
        background-color:  rgb(207, 120, 120)!important;
    }

    #sidebarMenu .btn-primary:hover {
        background-color:  rgb(207, 120, 120) !important;
    }

    /* Mantener el color del botón de cerrar sesión */
    #sidebarMenu .btn-danger {
        background-color: #dc3545 !important;
        border-color: #dc3545 !important;
    }

    #sidebarMenu .btn-danger:hover {
        background-color: #dc3545 !important;
        border-color: #dc3545 !important;
        box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25) !important;
    }

    /* Si deseas permitir una pequeña animación pero sin cambio de color */
    #sidebarMenu .btn:hover {
        transform: translateY(-2px);
        transition: transform 0.2s ease;
    }

    #sidebarMenu .btn-primary.sidebar-btn:hover {
        background-color:  rgb(207, 120, 120) !important;
        transform: translateY(-5px);
    }

    #sidebarMenu .btn-danger.sidebar-btn:hover {
        background-color: #dc3545 !important;
        transform: translateY(-5px);
    }

    /* Ajustar el ancho del offcanvas */
    .offcanvas-start {
        width: 320px;
        /* Dar más espacio al offcanvas */
    }

    /* Estilo para botones cuadrados */
    .sidebar-btn {
        aspect-ratio: 1/1;
        /* Garantiza forma cuadrada */
        width: 100%;
        /* Ocupa todo el ancho disponible */
        height: auto;
        /* La altura se ajusta automáticamente por aspect-ratio */
        padding: 15px 5px;
        /* Padding vertical más grande, horizontal más pequeño */
        margin: 0;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        transition: all 0.3s ease;
        border-radius: 10px;
        overflow: hidden;
    }

    .sidebar-btn i {
        font-size: 2rem;
        margin-bottom: 10px;
    }

    .sidebar-btn span {
        font-size: 0.85rem;
        font-weight: 500;
        text-align: center;
        line-height: 1.2;
        white-space: normal;
        /* Permitir múltiples líneas si es necesario */
    }

    /* Estilo para el botón de cerrar sesión que ocupa todo el ancho */
    .sidebar-btn-full {
        width: 100%;
        padding: 15px 10px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        transition: all 0.3s ease;
        border-radius: 10px;
    }

    /* Aumentar el espaciado del grid */
    .offcanvas-body .row {
        --bs-gutter-x: 10px;
        /* Espacio entre columnas */
        --bs-gutter-y: 10px;
        /* Espacio entre filas */
        justify-content: flex-start;
        /* Cambia a flex-end para moverlos más a la derecha */
        padding-left: 20px;
        /* Ajusta este valor para moverlos más hacia la derecha */
    }

    /* Asegurar que las columnas tengan el mismo tamaño */
    .offcanvas-body .col-6 {
        padding: 5px;
        /* Reducir el padding de las columnas */
    }

    #contenido-dinamico {
        transition: opacity 0.3s ease;
        margin: 0 auto;
        max-width: 95%;
        padding: 0 15px;
    }

    .cargando {
        opacity: 0.5;
        pointer-events: none;
    }

    .hidden {
        display: none !important;
    }

    /* Ajustar margen para todas las secciones */
    #dashboard-section,
    #ofertas-section,
    #postulaciones-section,
    #perfil-section {
        margin: 0 auto;
        padding: 20px 5px;
        width: 95%;
    }

    #perfil-section .btn:hover {
        background-color: #30336b;
        color: white;
    }

    /* Reducir el padding en dispositivos móviles */
    @media (max-width: 768px) {
        #contenido-dinamico {
            max-width: 98%;
            padding: 0 5px;
        }

        #dashboard-section,
        #ofertas-section,
        #postulaciones-section,
        #perfil-section {
            padding: 15px 5px;
        }

        .table-responsive {
            width: 98%;
        }
    }

    /* Estilo para los botones del menú */
    .menu-btn {
        aspect-ratio: 1/1;
        border-radius: 8px;
        transition: all 0.3s ease;
        height: 100%;
        padding: 8px;
        /* Reduciendo el padding para hacerlos más pequeños */
    }

    .menu-btn i {
        font-size: 1.5rem;
        /* Reduciendo el tamaño de los iconos */
        margin-bottom: 6px;
    }

    .menu-btn:hover {
        transform: translateY(-2px);
        /* Efecto hover más sutil */
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
    }

    .menu-btn span {
        font-size: 0.85rem;
        /* Texto más pequeño */
        font-weight: 500;
    }

    /* Colores sólidos para los botones */
    .btn-outline-primary {
        /* Color azul sólido */
        color: white;
        border: none;
    }

    .btn-outline-primary:hover {
        /* Color azul más oscuro al pasar el cursor */
        color: white;
    }

    .btn-outline-danger {
        background-color: #e74c3c;
        /* Color rojo sólido */
        color: white;
        border: none;
    }

    .btn-outline-danger:hover {
        background-color: #c0392b;
        /* Color rojo más oscuro al pasar el cursor */
        color: white;
    }


    /* Asegurar que los botones sean cuadrados en pantallas pequeñas */
    @media (max-width: 576px) {
        .menu-btn {
            padding: 8px;
            /* Padding aún más reducido en móviles */
        }

        .menu-btn i {
            font-size: 1.3rem;
            /* Iconos más pequeños en móviles */
            margin-bottom: 3px;
        }

        .menu-btn span {
            font-size: 0.75rem;
            /* Texto más pequeño en móviles */
        }
    }

    /* Estilo para el contenedor de la tabla */
    .table-responsive {
        width: 95%;
        margin: 0 auto;
    }

    /* Asegurar que la tabla ocupe todo el ancho del contenedor */
    #offersTable {
        width: 100% !important;
        min-width: 100%;
    }

    /* Centrar el contenido de las celdas */
    #offersTable td,
    #offersTable th {
        vertical-align: middle !important;
        text-align: center !important;
    }

    /* Excepción para la columna de título que puede mantenerse alineada a la izquierda */
    #offersTable td:nth-child(2) {
        text-align: left !important;
    }

    /* Ajustar el padding de las celdas */
    #offersTable td {
        padding: 12px 8px;
    }

    /* Estilo para los botones dentro de la tabla */
    #offersTable .btn {
        margin: 0 auto;
        display: block;
    }

    /* Forzar color de texto oscuro para opciones en selects dentro de modales */
    .modal-body select option {
        color: #212529; /* Color de texto oscuro estándar de Bootstrap */
        background-color: #fff; /* Asegurar fondo blanco */
    }

    /* Si lo anterior no funciona, intenta ser más específico o usar !important (con precaución) */
    /*
    #crearFeria .modal-body select option,
    #editarFeria .modal-body select option {
        color: #212529 !important;
        background-color: #fff !important;
    }
    */
</style>

<!-- Agregar después de cargar Bootstrap -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Inicializar todos los dropdowns en la página
        var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
        var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
            return new bootstrap.Dropdown(dropdownToggleEl, {
                autoClose: true // 'true' es el comportamiento por defecto, puedes ajustarlo si necesitas 'inside' o 'outside'
            });
        });

        // Inicializar el Offcanvas
        var offcanvasElement = document.getElementById('sidebarMenu');
        if (offcanvasElement) {
            var sidebarInstance = new bootstrap.Offcanvas(offcanvasElement);
            // Puedes interactuar con sidebarInstance si es necesario
        }

        // (Opcional) Si quieres cerrar el dropdown del perfil al hacer clic en un item
        document.querySelectorAll('#userMenu + .dropdown-menu .dropdown-item').forEach(function(item) {
            item.addEventListener('click', function() {
                var userMenuDropdown = bootstrap.Dropdown.getInstance(document.getElementById('userMenu'));
                if (userMenuDropdown) {
                    userMenuDropdown.hide(); // Cierra el dropdown específico
                }
            });
        });

        // Inicializar DataTables (si no lo haces ya en otro sitio específico)
        // $('#offersTable').DataTable({ ... });
        // $('#fairsTable').DataTable({ ... }); // Asegúrate de que el ID sea correcto
        // $('#usersTable').DataTable({ ... }); // Asegúrate de que el ID sea correcto

        // Cargar la sección inicial (por ejemplo, dashboard) si es necesario
        // mostrarSeccion('dashboard'); // O la sección por defecto que prefieras
    });

    function mostrarSeccion(seccion) {
        // Mostrar estado de carga
        const contenido = document.getElementById('contenido-dinamico');
        contenido.classList.add('cargando');

        // Ocultar todas las secciones principales
        document.querySelectorAll('#contenido-dinamico > div[id$="-section"]').forEach(div => {
            if (div.id.endsWith('-section')) {
                div.classList.add('hidden');
            }
        });

        // Mostrar la sección seleccionada
        const seccionAMostrar = document.getElementById(`${seccion}-section`);
        if (seccionAMostrar) {
            seccionAMostrar.classList.remove('hidden');
        } else {
            console.error(`La sección con ID ${seccion}-section no fue encontrada.`);
        }

        // Simular carga y quitar clase 'cargando'
        setTimeout(() => {
            contenido.classList.remove('cargando');
        }, 300);

        // Cerrar el offcanvas
        const sidebarMenuElement = document.getElementById('sidebarMenu');
        if (sidebarMenuElement) {
            const sidebarInstance = bootstrap.Offcanvas.getInstance(sidebarMenuElement);
            if (sidebarInstance) {
                sidebarInstance.hide();
            } else {
                console.warn('No se encontró la instancia de Bootstrap Offcanvas para #sidebarMenu.');
            }
        }
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="node_modules/bootstrap-icons/font/bootstrap-icons.css">

<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

<!-- jQuery (necesario para DataTables) -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<!-- DataTables JS -->
<script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

<!-- Inicializar los dropdowns -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inicializar dropdowns
        var dropdownElementList = document.querySelectorAll('.dropdown-toggle');
        var dropdownList = Array.from(dropdownElementList).map(function(element) {
            return new bootstrap.Dropdown(element, {
                autoClose: true
            });
        });

        // Añadir evento para cerrar el dropdown cuando se hace clic en un elemento
        document.querySelectorAll('.dropdown-item').forEach(function(item) {
            item.addEventListener('click', function() {
                document.querySelector('#userMenu').click(); // Cierra el dropdown manualmente
            });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inicializar dropdown con opciones
        const dropdownToggle = document.querySelector('#userMenu');
        if (dropdownToggle) {
            const dropdown = new bootstrap.Dropdown(dropdownToggle, {
                autoClose: true
            });
        }
    });
</script>

<script>
    // Función para cargar municipios según el departamento seleccionado
    document.getElementById('departamento_nuevo').addEventListener('change', function() {
        const departamentoId = this.value;
        const municipioSelect = document.getElementById('municipio_nuevo');

        // Limpiar select de municipios
        municipioSelect.innerHTML = '<option value="">Cargando municipios...</option>';

        if (departamentoId) {
            fetch(`components/empleos/get_municipalities.php?departamento=${departamentoId}`)
                .then(response => response.json())
                .then(data => {
                    municipioSelect.innerHTML = '<option value="">Seleccione un municipio</option>';
                    data.forEach(municipio => {
                        const option = document.createElement('option');
                        option.value = municipio.id;
                        option.textContent = municipio.nombre;
                        municipioSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                    municipioSelect.innerHTML = '<option value="">Error al cargar municipios</option>';
                });
        } else {
            municipioSelect.innerHTML = '<option value="">Seleccione primero un departamento</option>';
        }
    });
</script>

<script>
    // Event listener para cargar municipios en el formulario de actualización
    document.getElementById('departamento').addEventListener('change', function() {
        const departamentoId = this.value;
        const municipioSelect = document.getElementById('municipio');

        // Limpiar select de municipios
        municipioSelect.innerHTML = '<option value="">Cargando municipios...</option>';

        if (departamentoId) {
            fetch(`components/empleos/get_municipalities.php?departamento=${departamentoId}`)
                .then(response => response.json())
                .then(data => {
                    municipioSelect.innerHTML = '<option value="">Seleccione un municipio</option>';
                    data.forEach(municipio => {
                        const option = document.createElement('option');
                        option.value = municipio.id;
                        option.textContent = municipio.nombre;
                        municipioSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                    municipioSelect.innerHTML = '<option value="">Error al cargar municipios</option>';
                });
        } else {
            municipioSelect.innerHTML = '<option value="">Seleccione primero un departamento</option>';
        }
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Event listener para el select de departamento
        document.getElementById('departamento').addEventListener('change', function() {
            const departamentoId = this.value;
            const municipioSelect = document.getElementById('municipio');

            // Limpiar select de municipios
            municipioSelect.innerHTML = '<option value="">Cargando municipios...</option>';

            if (departamentoId) {
                fetch(`components/get_municipalities.php?departamento=${departamentoId}`)
                    .then(response => response.json())
                    .then(data => {
                        municipioSelect.innerHTML = '<option value="">Seleccione un municipio</option>';
                        data.forEach(municipio => {
                            const option = document.createElement('option');
                            option.value = municipio.cod_municipio;
                            option.textContent = municipio.nom_municipio;
                            municipioSelect.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        municipioSelect.innerHTML = '<option value="">Error al cargar municipios</option>';
                    });
            } else {
                municipioSelect.innerHTML = '<option value="">Seleccione primero un departamento</option>';
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#offersTable').DataTable({
            responsive: true,
            language: {
                url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
            },
            pagingType: "simple",
            order: [
                [5, 'desc']
            ] // Ordenar por fecha de publicación descendente
        });
    });
</script>

<?php
// Verificar si el usuario está logueado y es una empresa
if (!isset($_SESSION["loggedin"]) || $_SESSION["tipo"] !== "administrador") {
    header("location: login.php");
    exit;
}

// Incluir la conexión a la base de datos
require_once "controller/conexion.php";

// Ejemplo seguro usando consultas preparadas
$stmt = $conn->prepare("SELECT * FROM empleos WHERE empresa_id = ?");
$stmt->bind_param("i", $_SESSION['empresa_id']);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Empresa - SIVP</title>
    <!-- jQuery primero -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <!-- Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>

    <!-- Bootstrap CSS y JS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Tu CSS personalizado -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico?v=<?php echo time(); ?>">

    <link rel="stylesheet" href="css/dashboard.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <!-- Bootstrap JS -->
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="node_modules/bootstrap-icons/font/bootstrap-icons.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

    <!-- jQuery (necesario para DataTables) -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <!-- DataTables JS -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

    <style>
        .nav-link {
            background: none;
            border: none;
            text-align: left;
            width: 100%;
            cursor: pointer;
            color: white;
        }


        .sidebar {
            background-color: #30336b;
            /* Puedes cambiar este color por el que prefieras */
            min-height: 100vh;
        }

        .nav-link:hover,
        .nav-link.active {
            background-color: rgba(255, 255, 255, 0.1);
        }

        #contenido-dinamico {
            transition: opacity 0.3s ease;
        }

        .cargando {
            opacity: 0.5;
            pointer-events: none;
        }

        .hidden {
            display: none !important;
        }
    </style>
</head>

<body>



    <!-- Contenido principal -->
    <main class="px-3" id="contenido-dinamico">
        <!-- Sección Dashboard -->
        <div id="dashboard-section">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION["nombre"]); ?></h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Ofertas Activas</h5>
                            <?php
                            // Consulta para contar empleos activos
                            $sql_empleos = "SELECT COUNT(*) as total FROM empleos WHERE estado = 1";

                            $stmt = $conn->prepare($sql_empleos);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $empleos_activos = $result->fetch_assoc()['total'];
                            ?>
                            <p class="card-text display-4"><?php echo $empleos_activos; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Postulaciones pendientes</h5>
                            <?php
                            // Consulta para contar postulaciones pendientes
                            $sql_postulaciones = "SELECT COUNT(*) as total FROM postulaciones WHERE estado = 'pendiente'";

                            $stmt = $conn->prepare($sql_postulaciones);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $postulaciones_pendientes = $result->fetch_assoc()['total'];
                            ?>
                            <p class="card-text display-4"><?php echo $postulaciones_pendientes; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Ofertas Cerradas</h5>
                            <?php
                            // Consulta para contar empleos cerrados (estado = 0)
                            $sql_empleos = "SELECT COUNT(*) as total 
                                          FROM empleos 
                                          WHERE estado = 0";

                            $stmt = $conn->prepare($sql_empleos);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $empleos_inactivos = $result->fetch_assoc()['total'];
                            ?>
                            <p class="card-text display-4"><?php echo $empleos_inactivos; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección Ofertas -->
        <div id="ofertas-section" class="hidden">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1><i class="bi bi-briefcase-fill"></i> Matriz de ofertas</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <button class="btn text-white" style="background-color: #ec008c;" data-bs-toggle="modal" data-bs-target="#crearOferta">
                        <i class="fas fa-plus"></i> Crear Oferta
                    </button>
                </div>
            </div>

            <div class="table-responsive w-100">
                <?php include 'components/funciones_admin/offers_table.php'; ?>
            </div>
        </div>


        <!-- Sección Feria de empleo -->
        <div id="feria-section" class="hidden">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1><i class="bi bi-calendar-event-fill"></i> Feria de Empleo</h1>

            </div>

            <!-- Contenedor para la tabla de ferias -->
            <div class="table-responsive w-100">
                <?php
                // Incluir el archivo que contiene la tabla y la lógica de DataTables para ferias
                include 'components/funciones_admin/fairs_table.php';
                ?>
            </div>
        </div>

        <!-- Sección Talleres de empleo -->
        <div id="talleres-section" class="hidden">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1><i class="bi bi-calendar-event-fill"></i> Talleres de Empleo</h1>

            </div>

            <!-- Contenedor para la tabla de ferias -->
            <div class="table-responsive w-100">
                <?php
                // Incluir el archivo que contiene la tabla y la lógica de DataTables para ferias
                include 'components/funciones_admin/talleres_table.php';
                ?>
            </div>
        </div>

        <div id="usuarios-section" class="hidden">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1><i class="bi bi-people-fill"></i> Gestión de Usuarios</h1>
            </div>
            <div class="table-responsive w-100">
                <?php include 'components/funciones_admin/users_table.php'; ?>
            </div>
        </div>

        <!-- Sección Postulaciones -->
        <div id="postulaciones-section" class="hidden">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1>Postulaciones Recibidas</h1>
            </div>
            <div class="alert alert-info">
                Listado de postulaciones aparecerá aquí
            </div>
        </div>

        <!-- Sección Perfil -->
        <div id="perfil-section" class="hidden">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1>Mi Perfil</h1>
            </div>

            <?php
            // Obtener datos de la empresa
            $sql = "SELECT e.*, u.foto_perfil, u.telefono, u.email 
                        FROM empresas e 
                        INNER JOIN usuarios u ON e.usuario_id = u.numero_id 
                        WHERE e.usuario_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $_SESSION['numero_id']);
            $stmt->execute();
            $empresa = $stmt->get_result()->fetch_assoc();
            ?>

            <div class="container py-4">
                <div class="row">
                    <!-- Columna del logo y datos básicos -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <img src="/Job_Board/uploads/profilePics/<?php echo htmlspecialchars($empresa['foto_perfil']); ?>"
                                    alt="Logo empresa"
                                    class="img-fluid rounded-circle mb-3"
                                    style="width: 150px; height: 150px; object-fit: cover;">
                                <h3><?php echo htmlspecialchars($empresa['nombre']); ?></h3>
                                <p class="text-muted">
                                    <i class="fas fa-envelope me-2"></i><?php echo htmlspecialchars($empresa['email']); ?>
                                </p>
                                <p class="text-muted">
                                    <i class="fas fa-phone me-2"></i><?php echo htmlspecialchars($empresa['telefono']); ?>
                                </p>
                                <button class="btn" onclick="editarFoto()">
                                    <i class="fas fa-camera me-2"></i>Cambiar Logo
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Columna de información detallada -->
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <form id="formPerfilEmpresa">
                                    <div class="mb-3">
                                        <label class="form-label">Descripción de la Empresa</label>
                                        <textarea class="form-control" name="descripcion" rows="4"><?php echo htmlspecialchars($empresa['descripcion']); ?></textarea>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Sitio Web</label>
                                            <input type="url" class="form-control" name="sitio_web"
                                                value="<?php echo htmlspecialchars($empresa['sitio_web']); ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Teléfono</label>
                                            <input type="tel" class="form-control" name="telefono"
                                                value="<?php echo htmlspecialchars($empresa['telefono']); ?>">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Ubicación</label>
                                        <input type="text" class="form-control" id="address" name="ubicacion"
                                            value="<?php echo htmlspecialchars($empresa['ubicacion']); ?>">
                                        <input type="hidden" id="latitud" name="latitud" value="<?php echo htmlspecialchars($empresa['latitud']); ?>">
                                        <input type="hidden" id="longitud" name="longitud" value="<?php echo htmlspecialchars($empresa['longitud']); ?>">
                                    </div>

                                    <button type="submit" class="btn">
                                        <i class="fas fa-save me-2"></i>Guardar Cambios
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <br>
    <br>

    <!-- Bootstrap Bundle with Popper -->
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script>
        function mostrarSeccion(seccion) {
            // Mostrar estado de carga
            const contenido = document.getElementById('contenido-dinamico');
            contenido.classList.add('cargando');

            // Remover clase 'active' de todos los botones
            document.querySelectorAll('.nav-link').forEach(link => {
                link.classList.remove('active');
            });

            // Agregar clase 'active' al botón correspondiente a esta sección
            document.querySelector(`.nav-link[onclick*="mostrarSeccion('${seccion}')"]`)?.classList.add('active');

            // Ocultar todas las secciones
            document.querySelectorAll('#contenido-dinamico > div').forEach(div => {
                div.classList.add('hidden');
            });

            // Mostrar la sección seleccionada
            document.getElementById(`${seccion}-section`).classList.remove('hidden');

            // Simular carga
            setTimeout(() => {
                contenido.classList.remove('cargando');
            }, 300);
        }
    </script>
</body>
<?php include 'controller/footer.php'; ?>

</html>