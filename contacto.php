<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>EShopper - Bootstrap Shop Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&family=Lora&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Parisienne&display=swap" rel="stylesheet">


    </head>

<body>
 <?php include 'header.php'; ?>

<?php include 'nav.php'; ?>  


    <!-- Page Header Start -->
    
<div class="container-fluid mb-3">
    <div class="d-flex flex-column align-items-center justify-content-center text-center" style="min-height: 100px">
        <h1 class="mb-3" style="font-size: 2rem; color:rgb(0, 0, 0); font-family: 'Nunito', sans-serif;">
            <strong>CONTÁCTANOS</strong>
        </h1>
        <h5 style="
            max-width: 800px;
            font-family: 'arial', serif;
            font-size: 1.1rem;
            text-align: center;
            line-height: 1.9;
            color: #rgb(0, 0, 0);;
            font-family: 'Nunito', sans-serif;">
            En <strong>Cher Ami</strong>, estamos para brindarte el mejor servicio. Si tienes alguna duda, inquietud o deseas 
            conocer más de nuestra marca, no dudes en <strong>contactarnos</strong>.
        </h5>
    </div>
</div>
    <!-- Page Header End -->

    <!-- Contact Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-7 mb-5">
                <div class="contact-form">
                    <div id="success"></div>
                    <h2 class= "m-4" style="font-family: 'Nunito', sans-serif;"><strong>Formulario de contacto</strong></h2>
                    <form name="sentMessage" id="contactForm" novalidate="novalidate">
                        <div class="control-group">
                            <input type="text" class="form-control" id="name" placeholder="Tu nombre"
                                required="required" data-validation-required-message="Por favor introduce tu nombre" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="email" class="form-control" id="email" placeholder="Tu correo electrónico"
                                required="required" data-validation-required-message="Por favor introduce tu correo electrónico" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="text" class="form-control" id="subject" placeholder="Asunto"
                                required="required" data-validation-required-message="Por favor introduce un asunto" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <textarea class="form-control" rows="6" id="message" placeholder="Mensaje"
                                required="required"
                                data-validation-required-message="Por favor introduce tu mensaje"></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div>
                            <button class="btn py-2 px-4" type="submit" id="sendMessageButton" style="background: rgba(207,142,148,1); color: #000; border: none;">
                                Enviar Mensaje
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-5 mb-5">
                <img src="img/contacto.jpg" alt="" class="img-fluid" style="border-radius: 10px;">
                <div class="d-flex flex-column mb-3">
                    <h5 class="font-weight-semi-bold mb-3 mt-3" style="font-family: 'Nunito', sans-serif;">Nuestro contácto</h5>
                    <div class="d-flex align-items-center mb-2">
                        <a href="https://wa.me/57321654987" target="_blank" style="font-size: 2rem; min-width: 2.5rem; color: rgba(207,142,148,1);">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <span class="ml-2" style="font-size: 1.1rem; color: #222;">321654987</span>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <a href="https://instagram.com/tuusuario" target="_blank" style="font-size: 2rem; min-width: 2.5rem; color: rgba(207,142,148,1);">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <span class="ml-2" style="font-size: 1.1rem; color: #222;">@CherAmi</span>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <a href="https://facebook.com/tuusuario" target="_blank" style="font-size: 2rem; min-width: 2.5rem; color: rgba(207,142,148,1);">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <span class="ml-2" style="font-size: 1.1rem; color: #222;">cheramistore</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->


    <?php include 'footer.php'; ?>


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>