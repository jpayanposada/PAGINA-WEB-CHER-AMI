<?php
include 'conexion.php';

$categoria = $_GET['categoria'];
$sql = "SELECT * FROM productos WHERE categoria = '$categoria'";
$resultado = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Productos de <?php echo ucfirst($categoria); ?></title>
</head>
<body>
    <h1><?php echo ucfirst($categoria); ?></h1>
    <a href="agregar.php?categoria=<?php echo $categoria; ?>">Agregar Producto</a>
    <table border="1">
        <tr>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Imagen</th>
            <th>Acciones</th>
        </tr>
        <?php while ($row = $resultado->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['nombre']; ?></td>
            <td>$<?php echo $row['precio']; ?></td>
            <td><img src="../imagenes/<?php echo $row['imagen']; ?>" width="100"></td>
            <td>
                <a href="editar.php?id=<?php echo $row['id']; ?>">Editar</a>
                <a href="eliminar.php?id=<?php echo $row['id']; ?>">Eliminar</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
