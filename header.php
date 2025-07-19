<head>
    <meta charset="utf-8">
    <title>Cher Ami - Adult Toy Store</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="img/favicon.png">
</head>

<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
<!-- Barra superior de redes sociales -->
<!-- Carrusel de frases en la barra superior -->
<div class="w-100 py-1" style="background-color: #f8d8cd; overflow: hidden;">
    <div id="topbar-carousel" class="d-flex align-items-center" style="height: 2.2em; position: relative; font-family: 'Nunito', sans-serif;">
        <span class="topbar-slide" style="font-size: 1.1em;">😍 ¡Bienvenidos a Cher Ami! Disfruta, explora y déjate sorprender. 😍</span>
        <span class="topbar-slide" style="font-size: 1.1em;">🎉 Envíos gratis por compras superiores a $100.000 🎉</span>
        <span class="topbar-slide" style="font-size: 1.1em;">💌 Síguenos en nuestras redes sociales para más sorpresas 💌</span>
        <span class="topbar-slide" style="font-size: 1.1em;">🛒 Compra fácil, rápido y seguro 🛒</span>
    </div>
</div>
<style>
#topbar-carousel {
    position: relative;
    width: 100%;
    justify-content: center;
}
.topbar-slide {
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    opacity: 0;
    transition: opacity 0.2s;
    white-space: nowrap;
}
.topbar-slide.active {
    opacity: 1;
    z-index: 2;
}
</style>
<script>
const slides = document.querySelectorAll('.topbar-slide');
let current = 0;
function showSlide(idx) {
    slides.forEach((el, i) => el.classList.toggle('active', i === idx));
}
showSlide(current);
setInterval(() => {
    current = (current + 1) % slides.length;
    showSlide(current);
}, 3500);
</script>

<!-- Topbar Start -->   
        <div class="container-fluid topbar-fijo row align-items-center px-xl-5" >  <!---->
            <div class="col-lg-12 d-flex justify-content-center">
                <a href="index.php" class="text-decoration-none">
                    <img src="img/logo-horizontal.png" alt="" style="height: 7em; margin-left: 15px; margin-right: 12px; border-radius: 8px;">
                </a>

                <!-- Menú principal centrado -->
                
                <nav class="navbar navbar-expand-lg bg-light navbar-light  w-100 mt-4" style="margin-left: 0px; border: none;">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-center" id="navbarCollapse">
                        <div class="navbar-nav ">
                            <a href="index.php" class="nav-item nav-link active" style="color: rgba(207,142,148,255);">Inicio</a>
                            <a href="nosotros.php" class="nav-item nav-link">Nosotros</a>
                            <a href="blog.php" class="nav-item nav-link">Blog</a>
                            <a href="contacto.php" class="nav-item nav-link">Contacto</a>
                            <a href="pqrs.php" class="nav-item nav-link">PQRS</a>
                        </div>
                    </div>
                    <a href="login.php" class="btn border-0" style="font-family: 'Montserrat', sans-serif;">
                        <i class="fas fa-user text-primary"></i>
                        <span class="ml-1">Admin</span>
                    </a>
                </nav>              
            </div>
        </div>

        
    <!-- Topbar End -->