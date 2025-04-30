<<<<<<< HEAD
<?php
// Incluir archivo de conexión
include_once("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario y sanitizarlos
    $cedula = intval($_POST['cedula']);
    $id_vehiculo = intval($_POST['id_vehiculo']);
    $fecha_inicio = htmlspecialchars($_POST['fecha_inicio']);
    $fecha_fin = htmlspecialchars($_POST['fecha_fin']);
    $metodo_pago = htmlspecialchars($_POST['metodo_pago']);
    $estado = htmlspecialchars($_POST['estado']);

    try {
        // Crear conexión a la base de datos
        $conexion = Cconexion::ConexionBD();

        // Preparar la consulta SQL para insertar datos
        $sql = "INSERT INTO reservaciones (cedula, id_vehiculo, fecha_inicio, fecha_fin, metodo_pago, estado)
                VALUES (:cedula, :id_vehiculo, :fecha_inicio, :fecha_fin, :metodo_pago, :estado)";
        $stmt = $conexion->prepare($sql);

        // Vincular parámetros
        $stmt->bindParam(':cedula', $cedula, PDO::PARAM_INT);
        $stmt->bindParam(':id_vehiculo', $id_vehiculo, PDO::PARAM_INT);
        $stmt->bindParam(':fecha_inicio', $fecha_inicio, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_fin', $fecha_fin, PDO::PARAM_STR);
        $stmt->bindParam(':metodo_pago', $metodo_pago, PDO::PARAM_STR);
        $stmt->bindParam(':estado', $estado, PDO::PARAM_STR);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "<script>alert('Reservación registrada correctamente.');</script>";
        } else {
            echo "<script>alert('Error al registrar la reservación.'); window.history.back();</script>";
        }

        // Consultar todas las reservaciones para mostrar los datos
        $consulta_sql = "SELECT * FROM reservaciones";
        $consulta_stmt = $conexion->prepare($consulta_sql);
        $consulta_stmt->execute();
        $reservaciones = $consulta_stmt->fetchAll(PDO::FETCH_ASSOC);

        // Mostrar los resultados
        echo "<h1>Reservaciones Registradas</h1>";
        echo "<table border='1' style='width:100%; text-align:left;'>";
        echo "<thead>
                <tr>
                    <th>ID Reservación</th>
                    <th>Cédula</th>
                    <th>ID Vehículo</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Método de Pago</th>
                    <th>Estado</th>
                </tr>
              </thead>";
        echo "<tbody>";
        foreach ($reservaciones as $reservacion) {
            echo "<tr>
                    <td>" . htmlspecialchars($reservacion['id_reservacion']) . "</td>
                    <td>" . htmlspecialchars($reservacion['cedula']) . "</td>
                    <td>" . htmlspecialchars($reservacion['id_vehiculo']) . "</td>
                    <td>" . htmlspecialchars($reservacion['fecha_inicio']) . "</td>
                    <td>" . htmlspecialchars($reservacion['fecha_fin']) . "</td>
                    <td>" . htmlspecialchars($reservacion['metodo_pago']) . "</td>
                    <td>" . htmlspecialchars($reservacion['estado']) . "</td>
                  </tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } catch (PDOException $e) {
        echo "Error en la conexión o consulta en el archivo: " . $e->getFile() . 
             " en la línea: " . $e->getLine() . 
             ". Detalles: " . $e->getMessage();
    }
}
?>
=======
<<<<<<< HEAD
<?php
// Incluir archivo de conexión
include_once("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario y sanitizarlos
    $cedula = intval($_POST['cedula']);
    $id_vehiculo = intval($_POST['id_vehiculo']);
    $fecha_inicio = htmlspecialchars($_POST['fecha_inicio']);
    $fecha_fin = htmlspecialchars($_POST['fecha_fin']);
    $metodo_pago = htmlspecialchars($_POST['metodo_pago']);
    $estado = htmlspecialchars($_POST['estado']);

    try {
        // Crear conexión a la base de datos
        $conexion = Cconexion::ConexionBD();

        // Preparar la consulta SQL para insertar datos
        $sql = "INSERT INTO reservaciones (cedula, id_vehiculo, fecha_inicio, fecha_fin, metodo_pago, estado)
                VALUES (:cedula, :id_vehiculo, :fecha_inicio, :fecha_fin, :metodo_pago, :estado)";
        $stmt = $conexion->prepare($sql);

        // Vincular parámetros
        $stmt->bindParam(':cedula', $cedula, PDO::PARAM_INT);
        $stmt->bindParam(':id_vehiculo', $id_vehiculo, PDO::PARAM_INT);
        $stmt->bindParam(':fecha_inicio', $fecha_inicio, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_fin', $fecha_fin, PDO::PARAM_STR);
        $stmt->bindParam(':metodo_pago', $metodo_pago, PDO::PARAM_STR);
        $stmt->bindParam(':estado', $estado, PDO::PARAM_STR);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "<script>alert('Reservación registrada correctamente.');</script>";
        } else {
            echo "<script>alert('Error al registrar la reservación.'); window.history.back();</script>";
        }

        // Consultar todas las reservaciones para mostrar los datos
        $consulta_sql = "SELECT * FROM reservaciones";
        $consulta_stmt = $conexion->prepare($consulta_sql);
        $consulta_stmt->execute();
        $reservaciones = $consulta_stmt->fetchAll(PDO::FETCH_ASSOC);

        // Mostrar los resultados
        echo "<h1>Reservaciones Registradas</h1>";
        echo "<table border='1' style='width:100%; text-align:left;'>";
        echo "<thead>
                <tr>
                    <th>ID Reservación</th>
                    <th>Cédula</th>
                    <th>ID Vehículo</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Método de Pago</th>
                    <th>Estado</th>
                </tr>
              </thead>";
        echo "<tbody>";
        foreach ($reservaciones as $reservacion) {
            echo "<tr>
                    <td>" . htmlspecialchars($reservacion['id_reservacion']) . "</td>
                    <td>" . htmlspecialchars($reservacion['cedula']) . "</td>
                    <td>" . htmlspecialchars($reservacion['id_vehiculo']) . "</td>
                    <td>" . htmlspecialchars($reservacion['fecha_inicio']) . "</td>
                    <td>" . htmlspecialchars($reservacion['fecha_fin']) . "</td>
                    <td>" . htmlspecialchars($reservacion['metodo_pago']) . "</td>
                    <td>" . htmlspecialchars($reservacion['estado']) . "</td>
                  </tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } catch (PDOException $e) {
        echo "Error en la conexión o consulta en el archivo: " . $e->getFile() . 
             " en la línea: " . $e->getLine() . 
             ". Detalles: " . $e->getMessage();
    }
}
?>
=======
<?php
// Incluir archivo de conexión
include_once("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario y sanitizarlos
    $cedula = intval($_POST['cedula']);
    $id_vehiculo = intval($_POST['id_vehiculo']);
    $fecha_inicio = htmlspecialchars($_POST['fecha_inicio']);
    $fecha_fin = htmlspecialchars($_POST['fecha_fin']);
    $metodo_pago = htmlspecialchars($_POST['metodo_pago']);
    $estado = htmlspecialchars($_POST['estado']);

    try {
        // Crear conexión a la base de datos
        $conexion = Cconexion::ConexionBD();

        // Preparar la consulta SQL para insertar datos
        $sql = "INSERT INTO reservaciones (cedula, id_vehiculo, fecha_inicio, fecha_fin, metodo_pago, estado)
                VALUES (:cedula, :id_vehiculo, :fecha_inicio, :fecha_fin, :metodo_pago, :estado)";
        $stmt = $conexion->prepare($sql);

        // Vincular parámetros
        $stmt->bindParam(':cedula', $cedula, PDO::PARAM_INT);
        $stmt->bindParam(':id_vehiculo', $id_vehiculo, PDO::PARAM_INT);
        $stmt->bindParam(':fecha_inicio', $fecha_inicio, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_fin', $fecha_fin, PDO::PARAM_STR);
        $stmt->bindParam(':metodo_pago', $metodo_pago, PDO::PARAM_STR);
        $stmt->bindParam(':estado', $estado, PDO::PARAM_STR);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "<script>alert('Reservación registrada correctamente.');</script>";
        } else {
            echo "<script>alert('Error al registrar la reservación.'); window.history.back();</script>";
        }

        // Consultar todas las reservaciones para mostrar los datos
        $consulta_sql = "SELECT * FROM reservaciones";
        $consulta_stmt = $conexion->prepare($consulta_sql);
        $consulta_stmt->execute();
        $reservaciones = $consulta_stmt->fetchAll(PDO::FETCH_ASSOC);

        // Mostrar los resultados
        echo "<h1>Reservaciones Registradas</h1>";
        echo "<table border='1' style='width:100%; text-align:left;'>";
        echo "<thead>
                <tr>
                    <th>ID Reservación</th>
                    <th>Cédula</th>
                    <th>ID Vehículo</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Método de Pago</th>
                    <th>Estado</th>
                </tr>
              </thead>";
        echo "<tbody>";
        foreach ($reservaciones as $reservacion) {
            echo "<tr>
                    <td>" . htmlspecialchars($reservacion['id_reservacion']) . "</td>
                    <td>" . htmlspecialchars($reservacion['cedula']) . "</td>
                    <td>" . htmlspecialchars($reservacion['id_vehiculo']) . "</td>
                    <td>" . htmlspecialchars($reservacion['fecha_inicio']) . "</td>
                    <td>" . htmlspecialchars($reservacion['fecha_fin']) . "</td>
                    <td>" . htmlspecialchars($reservacion['metodo_pago']) . "</td>
                    <td>" . htmlspecialchars($reservacion['estado']) . "</td>
                  </tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } catch (PDOException $e) {
        echo "Error en la conexión o consulta en el archivo: " . $e->getFile() . 
             " en la línea: " . $e->getLine() . 
             ". Detalles: " . $e->getMessage();
    }
}
?>
>>>>>>> 3b36bcf60ef3352292526c56cd1c2a3d013545b5
>>>>>>> 385b4c70925897719a0be7311cee9ece92ce7643
