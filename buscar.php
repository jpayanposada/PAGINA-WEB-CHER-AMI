<?php
header('Content-Type: application/json');
$q = isset($_GET['q']) ? strtolower(trim($_GET['q'])) : '';
$resultados = [];

if ($q !== '') {
    $paginas = [
        'juguetes.php' => 'Juguetes',
        'lenceria.php' => 'Lencería',
        'lubricantes.php' => 'Lubricantes',
        'arnes.php' => 'Arnés',
        'ellos.php' => 'Para ellos',
        'ellas.php' => 'Para ellas',
        'bondage.php' => 'Bondage',
        'bienestar.php' => 'Bienestar sexual',
        'otros.php' => 'Otros'
    ];
    $productos = [
        ['nombre' => 'Vibrador Clásico', 'archivo' => 'juguetes.php#vibrador-clasico'],
        ['nombre' => 'Lencería Sexy', 'archivo' => 'lenceria.php#lenceria-sexy'],
        ['nombre' => 'Lubricante Natural', 'archivo' => 'lubricantes.php#lubricante-natural'],
        // ... agrega más productos aquí ...
    ];
    foreach ($paginas as $archivo => $nombre) {
        if (strpos(strtolower($nombre), $q) !== false) {
            $resultados[] = [
                'archivo' => $archivo,
                'nombre' => $nombre
            ];
        }
    }
    foreach ($productos as $producto) {
        if (strpos(strtolower($producto['nombre']), $q) !== false) {
            $resultados[] = [
                'archivo' => $producto['archivo'],
                'nombre' => $producto['nombre']
            ];
        }
    }
}
echo json_encode(['resultados' => $resultados]);
?>