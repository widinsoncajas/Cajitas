<<<<<<< HEAD
<?php
// Incluir archivo de conexión
include_once("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario y sanitizarlos
    $marca = htmlspecialchars($_POST['marca']);
    $modelo = htmlspecialchars($_POST['modelo']);
    $anio = htmlspecialchars($_POST['anio']);
    $matricula = htmlspecialchars($_POST['matricula']);
    $estado = htmlspecialchars($_POST['estado']);
    $precio_dia = floatval($_POST['precio_dia']);
    $socio = htmlspecialchars($_POST['socio']);
    $gama = htmlspecialchars($_POST['gama']);

    try {
        // Crear conexión a la base de datos
        $conexion = Cconexion::ConexionBD();

        // Preparar la consulta SQL
        $sql = "INSERT INTO vehiculos (marca, modelo, anio, matricula, estado, precio_dia, id_socio,codig)
                VALUES (:marca, :modelo, :anio, :matricula, :estado, :precio_dia, :id_socio, :codig)";
        $stmt = $conexion->prepare($sql);

        // Vincular parámetros
        $stmt->bindParam(':marca', $marca, PDO::PARAM_STR);
        $stmt->bindParam(':modelo', $modelo, PDO::PARAM_STR);
        $stmt->bindParam(':anio', $anio, PDO::PARAM_INT);
        $stmt->bindParam(':matricula', $matricula, PDO::PARAM_STR);
        $stmt->bindParam(':estado', $estado, PDO::PARAM_STR);
        $stmt->bindParam(':precio_dia', $precio_dia, PDO::PARAM_STR);
        $stmt->bindParam(':id_socio', $socio, PDO::PARAM_INT);
        $stmt->bindParam(':codig', $codig, PDO::PARAM_INT);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "<script>
                alert('Vehículo registrado correctamente.');
                window.location.href = 'formulario_vehiculo.html';
            </script>";
        } else {
            echo "<script>
                alert('Error al registrar el vehículo.');
                window.history.back();
            </script>";
        }
    } catch (PDOException $e) {
        echo "Error en la conexión o consulta en el archivo: " . $e->getFile() . " en la línea: " . $e->getLine() . ". Detalles: " . $e->getMessage();

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
    $marca = htmlspecialchars($_POST['marca']);
    $modelo = htmlspecialchars($_POST['modelo']);
    $anio = htmlspecialchars($_POST['anio']);
    $matricula = htmlspecialchars($_POST['matricula']);
    $estado = htmlspecialchars($_POST['estado']);
    $precio_dia = floatval($_POST['precio_dia']);
    $socio = htmlspecialchars($_POST['socio']);
    $gama = htmlspecialchars($_POST['gama']);

    try {
        // Crear conexión a la base de datos
        $conexion = Cconexion::ConexionBD();

        // Preparar la consulta SQL
        $sql = "INSERT INTO vehiculos (marca, modelo, anio, matricula, estado, precio_dia, id_socio,codig)
                VALUES (:marca, :modelo, :anio, :matricula, :estado, :precio_dia, :id_socio, :codig)";
        $stmt = $conexion->prepare($sql);

        // Vincular parámetros
        $stmt->bindParam(':marca', $marca, PDO::PARAM_STR);
        $stmt->bindParam(':modelo', $modelo, PDO::PARAM_STR);
        $stmt->bindParam(':anio', $anio, PDO::PARAM_INT);
        $stmt->bindParam(':matricula', $matricula, PDO::PARAM_STR);
        $stmt->bindParam(':estado', $estado, PDO::PARAM_STR);
        $stmt->bindParam(':precio_dia', $precio_dia, PDO::PARAM_STR);
        $stmt->bindParam(':id_socio', $socio, PDO::PARAM_INT);
        $stmt->bindParam(':codig', $codig, PDO::PARAM_INT);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "<script>
                alert('Vehículo registrado correctamente.');
                window.location.href = 'formulario_vehiculo.html';
            </script>";
        } else {
            echo "<script>
                alert('Error al registrar el vehículo.');
                window.history.back();
            </script>";
        }
    } catch (PDOException $e) {
        echo "Error en la conexión o consulta en el archivo: " . $e->getFile() . " en la línea: " . $e->getLine() . ". Detalles: " . $e->getMessage();

    }
}
?>
=======
<?php
// Incluir archivo de conexión
include_once("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario y sanitizarlos
    $marca = htmlspecialchars($_POST['marca']);
    $modelo = htmlspecialchars($_POST['modelo']);
    $anio = htmlspecialchars($_POST['anio']);
    $matricula = htmlspecialchars($_POST['matricula']);
    $estado = htmlspecialchars($_POST['estado']);
    $precio_dia = floatval($_POST['precio_dia']);
    $socio = htmlspecialchars($_POST['socio']);
    $gama = htmlspecialchars($_POST['gama']);

    try {
        // Crear conexión a la base de datos
        $conexion = Cconexion::ConexionBD();

        // Preparar la consulta SQL
        $sql = "INSERT INTO vehiculos (marca, modelo, anio, matricula, estado, precio_dia, id_socio,codig)
                VALUES (:marca, :modelo, :anio, :matricula, :estado, :precio_dia, :id_socio, :codig)";
        $stmt = $conexion->prepare($sql);

        // Vincular parámetros
        $stmt->bindParam(':marca', $marca, PDO::PARAM_STR);
        $stmt->bindParam(':modelo', $modelo, PDO::PARAM_STR);
        $stmt->bindParam(':anio', $anio, PDO::PARAM_INT);
        $stmt->bindParam(':matricula', $matricula, PDO::PARAM_STR);
        $stmt->bindParam(':estado', $estado, PDO::PARAM_STR);
        $stmt->bindParam(':precio_dia', $precio_dia, PDO::PARAM_STR);
        $stmt->bindParam(':id_socio', $socio, PDO::PARAM_INT);
        $stmt->bindParam(':codig', $codig, PDO::PARAM_INT);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "<script>
                alert('Vehículo registrado correctamente.');
                window.location.href = 'formulario_vehiculo.html';
            </script>";
        } else {
            echo "<script>
                alert('Error al registrar el vehículo.');
                window.history.back();
            </script>";
        }
    } catch (PDOException $e) {
        echo "Error en la conexión o consulta en el archivo: " . $e->getFile() . " en la línea: " . $e->getLine() . ". Detalles: " . $e->getMessage();

    }
}
?>
>>>>>>> 3b36bcf60ef3352292526c56cd1c2a3d013545b5
>>>>>>> 385b4c70925897719a0be7311cee9ece92ce7643
