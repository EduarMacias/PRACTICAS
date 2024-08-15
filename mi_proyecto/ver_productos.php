<?php
include 'db.php';

try {
    $stmt = $conn->prepare("SELECT * FROM vista_productos");
    $stmt->execute();
    $productos = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Error al obtener los productos: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos Registrados</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.datatables.net/2.1.2/css/dataTables.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdn.datatables.net/2.1.2/js/dataTables.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2>Productos Registrados</h2>
        <div class="table-container">
            <table id="myTable" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre del Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Categoría</th>
                        <th>Fecha de Expiración</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $producto) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($producto['codigo']); ?></td>
                            <td><?php echo htmlspecialchars($producto['nombreProducto']); ?></td>
                            <td><?php echo htmlspecialchars($producto['precio']); ?></td>
                            <td><?php echo htmlspecialchars($producto['cantidad']); ?></td>
                            <td><?php echo htmlspecialchars($producto['categoria']); ?></td>
                            <td><?php echo htmlspecialchars($producto['fechaExp']); ?></td>
                            <td>
                                <a href="editar_producto.php?codigo=<?php echo htmlspecialchars($producto['codigo']); ?>" class="btn btn-warning btn-editar">Editar</a>
                                <button class="btn btn-danger btn-eliminar" data-codigo="<?php echo htmlspecialchars($producto['codigo']); ?>">Eliminar</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div id="mensaje-eliminar"></div>
        <a href="index.php" class="btn btn-secondary btn-volver">Volver a Registrar Productos</a>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();

            $('.btn-eliminar').on('click', function() {
                var codigo = $(this).data('codigo');
                if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
                    $.ajax({
                        url: 'eliminar_producto.php',
                        type: 'POST',
                        data: { codigo: codigo },
                        success: function(response) {
                            $('#mensaje-eliminar').html(response);
                            location.reload();
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
