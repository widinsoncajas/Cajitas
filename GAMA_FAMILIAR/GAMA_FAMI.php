
<?php
// Incluir la conexión a la base de datos
include_once("../conexion.php");

$conexion = Cconexion::ConexionBD();

// Si se ha enviado el formulario de actualización
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["guardar"])) {
    $id_vehiculo = $_POST["id_vehiculo"];
    $marca = $_POST["marca"];
    $modelo = $_POST["modelo"];
    $anio = $_POST["anio"];
    $matricula = $_POST["matricula"];
    $estado = $_POST["estado"];
    $precio_dia = $_POST["precio_dia"];

    // Actualizar datos en la base de datos
    $sql = "UPDATE vehiculos SET marca = :marca, modelo = :modelo, anio = :anio, matricula = :matricula, estado = :estado, precio_dia = :precio_dia WHERE id_vehiculo = :id";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':marca', $marca);
    $stmt->bindParam(':modelo', $modelo);
    $stmt->bindParam(':anio', $anio);
    $stmt->bindParam(':matricula', $matricula);
    $stmt->bindParam(':estado', $estado);
    $stmt->bindParam(':precio_dia', $precio_dia);
    $stmt->bindParam(':id', $id_vehiculo, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "<script>alert('Vehículo actualizado correctamente'); window.location.href=window.location.href;</script>";
    } else {
        echo "<script>alert('Error al actualizar el vehículo');</script>";
    }
}

// Obtener los vehículos de la base de datos
$sql = "SELECT * FROM vehiculos WHERE codig = 3";
$stmt = $conexion->prepare($sql);
$stmt->execute();
$vehiculos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Vehículos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
        }

        h2 {
            color: #007BFF;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007BFF;
            color: white;
        }

        img {
            width: 100px;
            border-radius: 5px;
        }

        .btn {
            padding: 8px 12px;
            margin: 5px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }

        .btn-edit {
            background-color: #ffc107;
            color: white;
        }

        .btn-delete {
            background-color: red;
            color: white;
        }

        .btn-rent {
            background-color: #28a745;
            color: white;
        }

        .btn-edit:hover {
            background-color: #e0a800;
        }

        .btn-delete:hover {
            background-color: darkred;
        }

        .btn-rent:hover {
            background-color: #218838;
        }

        .edit-form {
            display: none;
            background: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }
    </style>
    <script>
        function toggleEditForm(id) {
            let form = document.getElementById("edit-form-" + id);
            form.style.display = form.style.display === "none" ? "block" : "none";
        }
    </script>
</head>
<body>

    <h2>Gestión de Vehículos</h2>
    <a href="inventar_gama_fami.php" class="btn">Agregar Vehículo</a>

    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Año</th>
                    <th>Matrícula</th>
                    <th>Estado</th>
                    <th>Precio/Día</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($vehiculos as $vehiculo) : ?>
                    <tr>
                    <td><img src="<?php echo htmlspecialchars($vehiculo['imagen']); ?>" alt="Imagen" style="width: 200px; height: auto; border-radius: 10px;"></td>

                        <td><?php echo htmlspecialchars($vehiculo['marca']); ?></td>
                        <td><?php echo htmlspecialchars($vehiculo['modelo']); ?></td>
                        <td><?php echo htmlspecialchars($vehiculo['anio']); ?></td>
                        <td><?php echo htmlspecialchars($vehiculo['matricula']); ?></td>
                        <td><?php echo htmlspecialchars($vehiculo['estado']); ?></td>
                        <td>$<?php echo number_format($vehiculo['precio_dia'], 2); ?></td>
                        <td>
                            <button onclick="toggleEditForm('<?php echo $vehiculo['id_vehiculo']; ?>')" class="btn btn-edit">Editar</button>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="id_vehiculo" value="<?php echo $vehiculo['id_vehiculo']; ?>">
                                <button type="submit" name="eliminar" class="btn btn-delete" onclick="return confirm('¿Seguro que deseas eliminar este vehículo?');">Eliminar</button>
                            </form>
                            <a href="reservacion.php?id=<?php echo $vehiculo['id_vehiculo']; ?>" class="btn btn-rent">Alquilar</a>
                        </td>
                    </tr>
                    <!-- Formulario de Edición Oculto -->
                    <tr id="edit-form-<?php echo $vehiculo['id_vehiculo']; ?>" class="edit-form">
                        <td colspan="8">
                            <form method="POST">
                                <input type="hidden" name="id_vehiculo" value="<?php echo $vehiculo['id_vehiculo']; ?>">
                                <label>Marca:</label>
                                <input type="text" name="marca" value="<?php echo htmlspecialchars($vehiculo['marca']); ?>" required>
                                
                                <label>Modelo:</label>
                                <input type="text" name="modelo" value="<?php echo htmlspecialchars($vehiculo['modelo']); ?>" required>
                                
                                <label>Año:</label>
                                <input type="number" name="anio" value="<?php echo htmlspecialchars($vehiculo['anio']); ?>" required>
                                
                                <label>Matrícula:</label>
                                <input type="text" name="matricula" value="<?php echo htmlspecialchars($vehiculo['matricula']); ?>" required>
                                
                                <label>Estado:</label>
                                <input type="text" name="estado" value="<?php echo htmlspecialchars($vehiculo['estado']); ?>" required>
                                
                                <label>Precio/Día:</label>
                                <input type="number" name="precio_dia" value="<?php echo htmlspecialchars($vehiculo['precio_dia']); ?>" required>
                                
                                <button type="submit" name="guardar" class="btn btn-edit">Guardar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
