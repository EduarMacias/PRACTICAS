<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombreProducto'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    $categoria = $_POST['categoria'];
    $fechaExp = $_POST['fechaExp'];

    try {
        $sql = "INSERT INTO productos (codigo, nombreProducto, precio, cantidad, categoria, fechaExp) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$codigo, $nombre, $precio, $cantidad, $categoria, $fechaExp]);
        echo "Producto agregado exitosamente!";
    } catch (PDOException $e) {
        if ($e->errorInfo[1] == 1062) {
            echo "Error: El código del producto ya existe.";
        } else {
            echo "Error al agregar el producto: " . $e->getMessage();
        }
    }
}
?>
