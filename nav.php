<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">

<!-- Navbar Start -->
<div class="container-fluid mb-5">
    <div class="row border-top px-xl-5 align-items-center">

        <!-- Botón de categorías a la izquierda -->
        <div class="col-lg-2 d-none d-lg-block text-right" style="position: relative;">
            <a class="btn shadow-none d-flex align-items-center justify-content-between w-100"
               data-toggle="collapse" href="#navbar-vertical"
               style="background: rgba(207,142,148,255); height: 65px; margin-top: 10px; padding: 0 30px; font-family: inherit; border-radius: 3px; color: rgba(207,142,148,255)">
                <h6 class="m-0">Categorías</h6>
                <i class="fa fa-angle-down text-dark"></i>
            </a>
            <nav class="collapse navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0"
                 id="navbar-vertical"
                 style="position: absolute; top: 75px; left: 0; width: 100%; z-index: 1000;">
                <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                    <a href="juguetes.php" class="nav-item nav-link">Juguetes</a>
                    <a href="lenceria.php" class="nav-item nav-link">Lencería</a>
                    <a href="lubricantes.php" class="nav-item nav-link">Lubricantes</a>
                    <a href="arnes.php" class="nav-item nav-link">Arnés</a>
                    <a href="ellos.php" class="nav-item nav-link">Para ellos</a>
                    <a href="ellas.php" class="nav-item nav-link">Para ellas</a>
                    <a href="bondage.php" class="nav-item nav-link">Bondage</a>
                    <a href="bienestar.php" class="nav-item nav-link">Bienestar sexual</a>
                    <a href="otros.php" class="nav-item nav-link">Otros</a>
                </div>
            </nav>
        </div>

        <div class="col-lg-8 col-6 text-center">
            <!-- Formulario de búsqueda con AJAX -->
<form id="form-busqueda" class="input-group" style="max-width:800px; margin:auto;   font-family: 'Nunito', sans-serif;">
    <input type="text" class="form-control" name="q" id="input-busqueda" placeholder="Buscar..." required>
    <div class="input-group-append">
        <button class="btn btn-primary" type="submit">Buscar</button>
    </div>
</form>

<!-- Modal personalizado oculto por defecto -->
<div class="modal-bg" id="modalNoResultados" style="display:none;">
    <div class="modal-content">
        <h2>Sin resultados</h2>
        <p>No se encontraron resultados para tu búsqueda.</p>
        <button onclick="cerrarModal()">Cerrar</button>
    </div>
</div>
<style>
    .modal-bg {
        display: flex;
        align-items: center;
        justify-content: center;
        position: fixed;
        z-index: 9999;
        left: 0; top: 0; width: 100vw; height: 100vh;
        background: rgba(0,0,0,0.4);
    }
    .modal-content {
        background: #fff;
        padding: 2em 1.5em;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        text-align: center;
        max-width: 350px;
    }
    .modal-content button {
        margin-top: 1em;
        padding: 0.5em 1.5em;
        background:rgba(207,142,148,255)
        color: #fff;
        border: none;
        border-radius: 5px;
        font-weight: bold;
        cursor: pointer;
    }
    .modal-content button:hover {
        background:rgba(207,142,148,255)
    }
</style>
<script>
function cerrarModal() {
    document.getElementById('modalNoResultados').style.display = 'none';
    document.body.style.overflow = '';
}
document.getElementById('form-busqueda').addEventListener('submit', function(e) {
    e.preventDefault();
    var q = document.getElementById('input-busqueda').value.trim();
    if (!q) return;
    fetch('buscar.php?q=' + encodeURIComponent(q))
        .then(res => res.json())
        .then(data => {
            if (data.resultados.length === 1) {
                window.location.href = data.resultados[0].archivo;
            } else if (data.resultados.length > 1) {
                window.location.href = 'buscar.php?q=' + encodeURIComponent(q);
            } else {
                document.getElementById('modalNoResultados').style.display = 'flex';
                document.body.style.overflow = 'hidden';
            }
        });
});
</script>
            </div>
    </div>
</div>
<!-- Navbar End -->
