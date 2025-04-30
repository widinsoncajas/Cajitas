
<?php
// Incluir archivo de conexión
include_once("conexion.php");

try {
    // Crear conexión a la base de datos
    $conexion = Cconexion::ConexionBD();

    // Si se envía el formulario de edición
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["guardar"])) {
        $cedula = $_POST["cedula"];
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $telefono = $_POST["telefono"];
        $correo = $_POST["correo"];
        $direccion = $_POST["direccion"];

        // Actualizar los datos en la base de datos
        $sql_update = "UPDATE clientes SET nombre = :nombre, apellido = :apellido, telefono = :telefono, correo = :correo, direccion = :direccion WHERE cedula = :cedula";
        $stmt_update = $conexion->prepare($sql_update);
        $stmt_update->bindParam(':cedula', $cedula);
        $stmt_update->bindParam(':nombre', $nombre);
        $stmt_update->bindParam(':apellido', $apellido);
        $stmt_update->bindParam(':telefono', $telefono);
        $stmt_update->bindParam(':correo', $correo);
        $stmt_update->bindParam(':direccion', $direccion);

        if ($stmt_update->execute()) {
            echo "<script>alert('Cliente actualizado correctamente');</script>";
        } else {
            echo "<script>alert('Error al actualizar el cliente');</script>";
        }
    }

    // Consulta SQL para obtener todos los clientes
    $consulta_sql = "SELECT * FROM clientes";
    $consulta_stmt = $conexion->prepare($consulta_sql);
    $consulta_stmt->execute();
    $clientes = $consulta_stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error en la conexión o consulta: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Lista de Clientes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #007BFF;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table thead {
            background-color: #007BFF;
            color: white;
        }
        table th, table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        table tbody tr:hover {
            background-color: #f1f1f1;
        }
        .btn {
            padding: 5px 10px;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }
        .btn-edit {
            background-color: #28a745;
        }
        .btn-delete {
            background-color: #dc3545;
        }
        .edit-form {
            display: none;
            background-color: #fff;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 10px;
        }
        input {
            padding: 5px;
            width: 100%;
            margin: 5px 0;
        }
    </style>
    <script>
        function toggleEditForm(cedula) {
            let form = document.getElementById("edit-form-" + cedula);
            form.style.display = form.style.display === "none" ? "block" : "none";
        }
    </script>
</head>
<body>

<h1>Lista de Clientes</h1>

<table>
    <thead>
        <tr>
            <th>Cédula</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Teléfono</th>
            <th>Correo</th>
            <th>Dirección</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($clientes as $cliente) : ?>
            <tr>
                <td><?php echo htmlspecialchars($cliente['cedula']); ?></td>
                <td><?php echo htmlspecialchars($cliente['nombre']); ?></td>
                <td><?php echo htmlspecialchars($cliente['apellido']); ?></td>
                <td><?php echo htmlspecialchars($cliente['telefono']); ?></td>
                <td><?php echo htmlspecialchars($cliente['correo']); ?></td>
                <td><?php echo htmlspecialchars($cliente['direccion']); ?></td>
                <td>
                    <button onclick="toggleEditForm('<?php echo $cliente['cedula']; ?>')" class="btn btn-edit">Editar</button>
                    <a href="eliminar_cliente.php?cedula=<?php echo urlencode($cliente['cedula']); ?>" class="btn btn-delete" onclick="return confirm('¿Estás seguro de eliminar este cliente?');">Eliminar</a>
                </td>
            </tr>
            <!-- Formulario de Edición Oculto -->
            <tr id="edit-form-<?php echo $cliente['cedula']; ?>" class="edit-form">
                <td colspan="7">
                    <form method="POST">
                        <input type="hidden" name="cedula" value="<?php echo $cliente['cedula']; ?>">
                        <label>Nombre:</label>
                        <input type="text" name="nombre" value="<?php echo htmlspecialchars($cliente['nombre']); ?>" required>

                        <label>Apellido:</label>
                        <input type="text" name="apellido" value="<?php echo htmlspecialchars($cliente['apellido']); ?>" required>

                        <label>Teléfono:</label>
                        <input type="text" name="telefono" value="<?php echo htmlspecialchars($cliente['telefono']); ?>" required>

                        <label>Correo:</label>
                        <input type="email" name="correo" value="<?php echo htmlspecialchars($cliente['correo']); ?>" required>

                        <label>Dirección:</label>
                        <input type="text" name="direccion" value="<?php echo htmlspecialchars($cliente['direccion']); ?>" required>

                        <button type="submit" name="guardar" class="btn btn-edit">Guardar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>

