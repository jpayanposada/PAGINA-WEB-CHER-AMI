<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>PQRS | Cher Ami</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="img/favicon.ico" rel="icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        .pqrs-header {
            background: rgba(207,142,148,0.12);
            padding: 2.5rem 0 1.5rem 0;
            text-align: center;
        }
        .pqrs-header h1 {
            color: rgba(207,142,148,1);
            font-family: 'Nunito', sans-serif;
            font-weight: bold;
        }
        .pqrs-header p {
            color: #333;
            font-size: 1.1rem;
            max-width: 700px;
            margin: 0 auto;
            font-family: 'Nunito', sans-serif;
        }
        .pqrs-form-container {
            max-width: 600px;
            margin: 2rem auto 3rem auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(207,142,148,0.08);
            padding: 2.5rem 2rem;
        }
        .pqrs-form label {
            font-weight: 600;
            color: rgba(207,142,148,1);
            font-family: 'Nunito', sans-serif;
        }
        .pqrs-form .form-control, .pqrs-form select {
            border-radius: 6px;
            border: 1px solid #e5e5e5;
            margin-bottom: 1.2rem;
        }
        .pqrs-form button {
            background: rgba(207,142,148,1);
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 0.7rem 2.2rem;
            font-weight: bold;
            font-family: 'Nunito', sans-serif;
            transition: background 0.2s;
        }
        .pqrs-form button:hover {
            background: rgba(207,120,120,1);
        }
        .pqrs-success {
            color: #28a745;
            font-weight: bold;
            margin-bottom: 1rem;
            text-align: center;
        }
    </style>
</head>

<body>
<?php include 'header.php'; ?>
<?php include 'nav.php'; ?>

<div class="pqrs-header">
    <h1>PQRS - Peticiones, Quejas, Reclamos y Sugerencias</h1>
    <p>
        En <strong>Cher Ami</strong> queremos escucharte. Si tienes una petición, queja, reclamo o sugerencia sobre nuestros productos o servicios, por favor diligencia el siguiente formulario y te responderemos lo más pronto posible.
    </p>
</div>

<div class="pqrs-form-container">
    <?php if (isset($_GET['enviado'])): ?>
        <div class="pqrs-success">¡Tu mensaje ha sido enviado exitosamente! Pronto nos pondremos en contacto contigo.</div>
    <?php endif; ?>
    <form class="pqrs-form" method="post" action="mail/pqrs.php">
        <label for="nombre">Nombre completo</label>
        <input type="text" class="form-control" id="nombre" name="nombre" required placeholder="Tu nombre completo">

        <label for="email">Correo electrónico</label>
        <input type="email" class="form-control" id="email" name="email" required placeholder="Tu correo electrónico">

        <label for="tipo">Tipo de solicitud</label>
        <select class="form-control" id="tipo" name="tipo" required>
            <option value="">Selecciona una opción</option>
            <option value="Petición">Petición</option>
            <option value="Queja">Queja</option>
            <option value="Reclamo">Reclamo</option>
            <option value="Sugerencia">Sugerencia</option>
        </select>

        <label for="mensaje">Mensaje</label>
        <textarea class="form-control" id="mensaje" name="mensaje" rows="5" required placeholder="Escribe aquí tu mensaje"></textarea>

        <button type="submit">Enviar PQRS</button>
    </form>
</div>

<?php include 'footer.php'; ?>

<a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="mail/jqBootstrapValidation.min.js"></script>
<script src="mail/contact.js"></script>
<script src="js/main.js"></script>
</body>
</html>