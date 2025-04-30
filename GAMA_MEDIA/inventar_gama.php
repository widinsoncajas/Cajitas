<<<<<<< HEAD
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = 'localhost';
    $dbname = 'FAZ_CAR_QUEVEDO2';
    $username = 'sa';
    $pasword = '12345678';
    $puerto = 1433;

    try {
        $conn = new PDO("sqlsrv:Server=$host,$puerto;Database=$dbname", $username, $pasword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Recoger datos del formulario
        $nombreArchivo = htmlspecialchars($_POST['nombre_archivo']);
        $marca = htmlspecialchars($_POST['marca']);
        $modelo = htmlspecialchars($_POST['modelo']);
        $anio = filter_var($_POST['anio'], FILTER_SANITIZE_NUMBER_INT);
        $matricula = htmlspecialchars($_POST['matricula']);
        $estado = htmlspecialchars($_POST['estado']);
        $precio_dia = filter_var($_POST['precio_dia'], FILTER_VALIDATE_FLOAT);
        $socio = htmlspecialchars($_POST['socio']);
        $codig = $_POST['codig'];

        // Insertar el vehículo
        $sql = "INSERT INTO vehiculos (marca, modelo, anio, matricula, estado, precio_dia, cedula, codig) 
                VALUES (:marca, :modelo, :anio, :matricula, :estado, :precio_dia, :cedula, :codig)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':marca', $marca);
        $stmt->bindParam(':modelo', $modelo);
        $stmt->bindParam(':anio', $anio, PDO::PARAM_INT);
        $stmt->bindParam(':matricula', $matricula);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':precio_dia', $precio_dia);
        $stmt->bindParam(':cedula', $socio);
        $stmt->bindParam(':codig', $codig, PDO::PARAM_INT);
        $stmt->execute();

        // Obtener el ID del vehículo recién insertado
        $vehiculo_id = $conn->lastInsertId();

        // Manejo de las imágenes
        $directorio = "imagenes_vehiculos/";
        if (!is_dir($directorio)) {
            mkdir($directorio, 0777, true);
        }

        if (!empty($_FILES['imagen']['name'][0])) {
            foreach ($_FILES['imagen']['tmp_name'] as $key => $tmp_name) {
                if ($_FILES['imagen']['error'][$key] === UPLOAD_ERR_OK) {
                    $nombreOriginal = basename($_FILES['imagen']['name'][$key]);
                    $rutaImagen = $directorio . uniqid() . "_" . $nombreOriginal;

                    if (move_uploaded_file($tmp_name, $rutaImagen)) {
                        $stmtImg = $conn->prepare("INSERT INTO imagenes_vehiculos (id_vehiculo, ruta_imagen) 
                                                   VALUES (:id_vehiculo, :ruta)");
                        $stmtImg->bindParam(':id_vehiculo', $vehiculo_id, PDO::PARAM_INT); // <--- CORREGIDO
                        $stmtImg->bindParam(':ruta', $rutaImagen);
                        $stmtImg->execute();
                    }
                }
            }
            echo "<p>Imágenes subidas correctamente.</p>";
        }

        echo "<p>Vehículo registrado exitosamente.</p>";
    } catch (PDOException $e) {
        echo "<p>Error en la base de datos: " . $e->getMessage() . "</p>";
    }

    $conn = null;
}
?>
=======
<<<<<<< HEAD
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = 'localhost';
    $dbname = 'FAZ_CAR_QUEVEDO2';
    $username = 'sa';
    $pasword = '12345678';
    $puerto = 1433;

    try {
        $conn = new PDO("sqlsrv:Server=$host,$puerto;Database=$dbname", $username, $pasword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Recoger datos del formulario
        $nombreArchivo = htmlspecialchars($_POST['nombre_archivo']);
        $marca = htmlspecialchars($_POST['marca']);
        $modelo = htmlspecialchars($_POST['modelo']);
        $anio = filter_var($_POST['anio'], FILTER_SANITIZE_NUMBER_INT);
        $matricula = htmlspecialchars($_POST['matricula']);
        $estado = htmlspecialchars($_POST['estado']);
        $precio_dia = filter_var($_POST['precio_dia'], FILTER_VALIDATE_FLOAT);
        $socio = htmlspecialchars($_POST['socio']);
        $codig = $_POST['codig'];

        // Insertar el vehículo
        $sql = "INSERT INTO vehiculos (marca, modelo, anio, matricula, estado, precio_dia, cedula, codig) 
                VALUES (:marca, :modelo, :anio, :matricula, :estado, :precio_dia, :cedula, :codig)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':marca', $marca);
        $stmt->bindParam(':modelo', $modelo);
        $stmt->bindParam(':anio', $anio, PDO::PARAM_INT);
        $stmt->bindParam(':matricula', $matricula);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':precio_dia', $precio_dia);
        $stmt->bindParam(':cedula', $socio);
        $stmt->bindParam(':codig', $codig, PDO::PARAM_INT);
        $stmt->execute();

        // Obtener el ID del vehículo recién insertado
        $vehiculo_id = $conn->lastInsertId();

        // Manejo de las imágenes
        $directorio = "imagenes_vehiculos/";
        if (!is_dir($directorio)) {
            mkdir($directorio, 0777, true);
        }

        if (!empty($_FILES['imagen']['name'][0])) {
            foreach ($_FILES['imagen']['tmp_name'] as $key => $tmp_name) {
                if ($_FILES['imagen']['error'][$key] === UPLOAD_ERR_OK) {
                    $nombreOriginal = basename($_FILES['imagen']['name'][$key]);
                    $rutaImagen = $directorio . uniqid() . "_" . $nombreOriginal;

                    if (move_uploaded_file($tmp_name, $rutaImagen)) {
                        $stmtImg = $conn->prepare("INSERT INTO imagenes_vehiculos (id_vehiculo, ruta_imagen) 
                                                   VALUES (:id_vehiculo, :ruta)");
                        $stmtImg->bindParam(':id_vehiculo', $vehiculo_id, PDO::PARAM_INT); // <--- CORREGIDO
                        $stmtImg->bindParam(':ruta', $rutaImagen);
                        $stmtImg->execute();
                    }
                }
            }
            echo "<p>Imágenes subidas correctamente.</p>";
        }

        echo "<p>Vehículo registrado exitosamente.</p>";
    } catch (PDOException $e) {
        echo "<p>Error en la base de datos: " . $e->getMessage() . "</p>";
    }

    $conn = null;
}
?>
=======
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = 'localhost';
    $dbname = 'FAZ_CAR_QUEVEDO2';
    $username = 'sa';
    $pasword = '12345678';
    $puerto = 1433;

    try {
        $conn = new PDO("sqlsrv:Server=$host,$puerto;Database=$dbname", $username, $pasword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Recoger datos del formulario
        $nombreArchivo = htmlspecialchars($_POST['nombre_archivo']);
        $marca = htmlspecialchars($_POST['marca']);
        $modelo = htmlspecialchars($_POST['modelo']);
        $anio = filter_var($_POST['anio'], FILTER_SANITIZE_NUMBER_INT);
        $matricula = htmlspecialchars($_POST['matricula']);
        $estado = htmlspecialchars($_POST['estado']);
        $precio_dia = filter_var($_POST['precio_dia'], FILTER_VALIDATE_FLOAT);
        $socio = htmlspecialchars($_POST['socio']);
        $codig = $_POST['codig'];

        // Insertar el vehículo
        $sql = "INSERT INTO vehiculos (marca, modelo, anio, matricula, estado, precio_dia, cedula, codig) 
                VALUES (:marca, :modelo, :anio, :matricula, :estado, :precio_dia, :cedula, :codig)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':marca', $marca);
        $stmt->bindParam(':modelo', $modelo);
        $stmt->bindParam(':anio', $anio, PDO::PARAM_INT);
        $stmt->bindParam(':matricula', $matricula);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':precio_dia', $precio_dia);
        $stmt->bindParam(':cedula', $socio);
        $stmt->bindParam(':codig', $codig, PDO::PARAM_INT);
        $stmt->execute();

        // Obtener el ID del vehículo recién insertado
        $vehiculo_id = $conn->lastInsertId();

        // Manejo de las imágenes
        $directorio = "imagenes_vehiculos/";
        if (!is_dir($directorio)) {
            mkdir($directorio, 0777, true);
        }

        if (!empty($_FILES['imagen']['name'][0])) {
            foreach ($_FILES['imagen']['tmp_name'] as $key => $tmp_name) {
                if ($_FILES['imagen']['error'][$key] === UPLOAD_ERR_OK) {
                    $nombreOriginal = basename($_FILES['imagen']['name'][$key]);
                    $rutaImagen = $directorio . uniqid() . "_" . $nombreOriginal;

                    if (move_uploaded_file($tmp_name, $rutaImagen)) {
                        $stmtImg = $conn->prepare("INSERT INTO imagenes_vehiculos (id_vehiculo, ruta_imagen) 
                                                   VALUES (:id_vehiculo, :ruta)");
                        $stmtImg->bindParam(':id_vehiculo', $vehiculo_id, PDO::PARAM_INT); // <--- CORREGIDO
                        $stmtImg->bindParam(':ruta', $rutaImagen);
                        $stmtImg->execute();
                    }
                }
            }
            echo "<p>Imágenes subidas correctamente.</p>";
        }

        echo "<p>Vehículo registrado exitosamente.</p>";
    } catch (PDOException $e) {
        echo "<p>Error en la base de datos: " . $e->getMessage() . "</p>";
    }

    $conn = null;
}
?>
>>>>>>> 3b36bcf60ef3352292526c56cd1c2a3d013545b5
>>>>>>> 385b4c70925897719a0be7311cee9ece92ce7643
