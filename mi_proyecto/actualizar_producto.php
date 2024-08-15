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
        $sql = "UPDATE productos SET nombreProducto = ?, precio = ?, cantidad = ?, categoria = ?, fechaExp = ? WHERE codigo = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$nombre, $precio, $cantidad, $categoria, $fechaExp, $codigo]);
        echo "Producto actualizado exitosamente!";
    } catch (PDOException $e) {
        echo "Error al actualizar el producto: " . $e->getMessage();
    }
}
?>
