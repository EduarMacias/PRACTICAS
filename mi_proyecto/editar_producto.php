<?php
include 'db.php';

if (isset($_GET['codigo'])) {
    $codigo = $_GET['codigo'];
    try {
        $stmt = $conn->prepare("SELECT * FROM productos WHERE codigo = ?");
        $stmt->execute([$codigo]);
        $producto = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$producto) {
            echo "Producto no encontrado.";
            exit;
        }
    } catch (PDOException $e) {
        echo "Error al obtener el producto: " . $e->getMessage();
        exit;
    }
} else {
    echo "Código de producto no especificado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background-color: #E0F7FA;
            color: #006064;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .container {
            width: 100%;
            max-width: 500px;
        }
        .card {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 0.5rem;
            background-color: #FFFFFF;
            padding: 1rem;
        }
        .card-header {
            background-color: #B2EBF2;
            color: #006064;
            text-align: center;
            padding: 1rem;
            border-radius: 0.5rem 0.5rem 0 0;
        }
        .card-body {
            padding: 1rem;
        }
        .form-label {
            font-weight: bold;
        }
        .form-control {
            border-radius: 0.25rem;
            border: 2px solid #B2EBF2;
            color: #006064;
            margin-bottom: 1rem;
        }
        .btn-primary {
            background-color: #00ACC1;
            border-color: #00ACC1;
            border-radius: 0.25rem;
            width: 100%;
        }
        .btn-secondary {
            background-color: #00796B;
            border-color: #00796B;
            border-radius: 0.25rem;
            width: 100%;
        }
        #mensaje-editar {
            margin-top: 1rem;
            text-align: center;
        }
        .mt-3 {
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h2>Editar Producto</h2>
            </div>
            <div class="card-body">
                <form id="form-editar" method="post">
                    <input type="hidden" name="codigo" value="<?php echo htmlspecialchars($producto['codigo']); ?>">
                    <div class="mb-3">
                        <label for="nombreProducto" class="form-label">Nombre del Producto:</label>
                        <input type="text" class="form-control" id="nombreProducto" name="nombreProducto" value="<?php echo htmlspecialchars($producto['nombreProducto']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio:</label>
                        <input type="text" class="form-control" id="precio" name="precio" value="<?php echo htmlspecialchars($producto['precio']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="cantidad" class="form-label">Cantidad:</label>
                        <input type="number" class="form-control" id="cantidad" name="cantidad" value="<?php echo htmlspecialchars($producto['cantidad']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="categoria" class="form-label">Categoría:</label>
                        <input type="text" class="form-control" id="categoria" name="categoria" value="<?php echo htmlspecialchars($producto['categoria']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="fechaExp" class="form-label">Fecha de Expiración:</label>
                        <input type="date" class="form-control" id="fechaExp" name="fechaExp" value="<?php echo htmlspecialchars($producto['fechaExp']); ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar Producto</button>
                </form>
                <div id="mensaje-editar"></div>
                <a href="ver_productos.php" class="btn btn-secondary mt-3">Volver a Ver Productos</a>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script>
        $('#form-editar').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: 'actualizar_producto.php',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    $('#mensaje-editar').html(response);
                }
            });
        });
    </script>
</body>
</html>
