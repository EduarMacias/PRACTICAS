<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Productos</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h2>Agregar Producto</h2>
            </div>
            <div class="card-body">
                <form id="form-insertar" method="post">
                    <div class="mb-3">
                        <label for="codigo" class="form-label">Código del Producto:</label>
                        <input type="text" class="form-control" id="codigo" name="codigo" required>
                    </div>
                    <div class="mb-3">
                        <label for="nombreProducto" class="form-label">Nombre del Producto:</label>
                        <input type="text" class="form-control" id="nombreProducto" name="nombreProducto" required>
                    </div>
                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio:</label>
                        <input type="text" class="form-control" id="precio" name="precio" required>
                    </div>
                    <div class="mb-3">
                        <label for="cantidad" class="form-label">Cantidad:</label>
                        <input type="number" class="form-control" id="cantidad" name="cantidad" required>
                    </div>
                    <div class="mb-3">
                        <label for="categoria" class="form-label">Categoría:</label>
                        <input type="text" class="form-control" id="categoria" name="categoria" required>
                    </div>
                    <div class="mb-3">
                        <label for="fechaExp" class="form-label">Fecha de Expiración:</label>
                        <input type="date" class="form-control" id="fechaExp" name="fechaExp" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar Producto</button>
                </form>
                <div id="mensaje-insertar"></div>
                <a href="ver_productos.php" class="btn btn-secondary mt-3">Ver Productos Registrados</a>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script>
        $('#form-insertar').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: 'insertar_producto.php',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    $('#mensaje-insertar').html(response);
                    $('#form-insertar')[0].reset();
                }
            });
        });
    </script>
</body>
</html>
