<<<<<<< HEAD
<?php
// Incluir archivo de conexión
include_once("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario y sanitizarlos
    $cedula = intval($_POST['cedula']); // Convertir a entero
    $nombre = htmlspecialchars($_POST['nombre']);
    $apellido = htmlspecialchars($_POST['apellido']);
    $telefono = htmlspecialchars($_POST['telefono']);
    $correo = htmlspecialchars($_POST['correo']);
    $direccion = htmlspecialchars($_POST['direccion']);

    try {
        // Crear conexión a la base de datos
        $conexion = Cconexion::ConexionBD();

        // Preparar la consulta SQL
        $sql = "INSERT INTO clientes (cedula, nombre, apellido, telefono, correo, direccion)
                VALUES (:cedula, :nombre, :apellido, :telefono, :correo, :direccion)";
        $stmt = $conexion->prepare($sql);

        // Vincular parámetros
        $stmt->bindParam(':cedula', $cedula, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':apellido', $apellido, PDO::PARAM_STR);
        $stmt->bindParam(':telefono', $telefono, PDO::PARAM_STR);
        $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
        $stmt->bindParam(':direccion', $direccion, PDO::PARAM_STR);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "<script>
                alert('Cliente registrado correctamente.');
                window.location.href = 'formulario_cliente.html';
            </script>";
        } else {
            echo "<script>
                alert('Error al registrar el cliente.');
                window.history.back();
            </script>";
        }
    } catch (PDOException $e) {
        echo "Error en la conexión o consulta: " . $e->getMessage();
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
    $cedula = intval($_POST['cedula']); // Convertir a entero
    $nombre = htmlspecialchars($_POST['nombre']);
    $apellido = htmlspecialchars($_POST['apellido']);
    $telefono = htmlspecialchars($_POST['telefono']);
    $correo = htmlspecialchars($_POST['correo']);
    $direccion = htmlspecialchars($_POST['direccion']);

    try {
        // Crear conexión a la base de datos
        $conexion = Cconexion::ConexionBD();

        // Preparar la consulta SQL
        $sql = "INSERT INTO clientes (cedula, nombre, apellido, telefono, correo, direccion)
                VALUES (:cedula, :nombre, :apellido, :telefono, :correo, :direccion)";
        $stmt = $conexion->prepare($sql);

        // Vincular parámetros
        $stmt->bindParam(':cedula', $cedula, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':apellido', $apellido, PDO::PARAM_STR);
        $stmt->bindParam(':telefono', $telefono, PDO::PARAM_STR);
        $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
        $stmt->bindParam(':direccion', $direccion, PDO::PARAM_STR);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "<script>
                alert('Cliente registrado correctamente.');
                window.location.href = 'formulario_cliente.html';
            </script>";
        } else {
            echo "<script>
                alert('Error al registrar el cliente.');
                window.history.back();
            </script>";
        }
    } catch (PDOException $e) {
        echo "Error en la conexión o consulta: " . $e->getMessage();
    }
}
?>
=======
<?php
// Incluir archivo de conexión
include_once("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario y sanitizarlos
    $cedula = intval($_POST['cedula']); // Convertir a entero
    $nombre = htmlspecialchars($_POST['nombre']);
    $apellido = htmlspecialchars($_POST['apellido']);
    $telefono = htmlspecialchars($_POST['telefono']);
    $correo = htmlspecialchars($_POST['correo']);
    $direccion = htmlspecialchars($_POST['direccion']);

    try {
        // Crear conexión a la base de datos
        $conexion = Cconexion::ConexionBD();

        // Preparar la consulta SQL
        $sql = "INSERT INTO clientes (cedula, nombre, apellido, telefono, correo, direccion)
                VALUES (:cedula, :nombre, :apellido, :telefono, :correo, :direccion)";
        $stmt = $conexion->prepare($sql);

        // Vincular parámetros
        $stmt->bindParam(':cedula', $cedula, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':apellido', $apellido, PDO::PARAM_STR);
        $stmt->bindParam(':telefono', $telefono, PDO::PARAM_STR);
        $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
        $stmt->bindParam(':direccion', $direccion, PDO::PARAM_STR);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "<script>
                alert('Cliente registrado correctamente.');
                window.location.href = 'formulario_cliente.html';
            </script>";
        } else {
            echo "<script>
                alert('Error al registrar el cliente.');
                window.history.back();
            </script>";
        }
    } catch (PDOException $e) {
        echo "Error en la conexión o consulta: " . $e->getMessage();
    }
}
?>
>>>>>>> 3b36bcf60ef3352292526c56cd1c2a3d013545b5
>>>>>>> 385b4c70925897719a0be7311cee9ece92ce7643
