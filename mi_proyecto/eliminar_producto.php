<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo = $_POST['codigo'];

    try {
        $sql = "DELETE FROM productos WHERE codigo = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$codigo]);
        echo "Producto eliminado exitosamente!";
    } catch (PDOException $e) {
        echo "Error al eliminar el producto: " . $e->getMessage();
    }
}
?>
