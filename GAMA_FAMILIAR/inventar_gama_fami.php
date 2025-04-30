<<<<<<< HEAD
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Definir los parámetros de conexión a la base de datos
    $host = 'localhost';
    $dbname = 'FAZ_CAR_QUEVEDO2';
    $username = 'sa';
    $pasword = '12345678';
    $puerto = 1433;

    try {
        // Conectar a la base de datos con PDO
        $conn = new PDO("sqlsrv:Server=$host,$puerto;Database=$dbname", $username, $pasword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Recibir y validar datos del formulario
        $nombreArchivo = htmlspecialchars($_POST['nombre_archivo']);
        $marca = htmlspecialchars($_POST['marca']);
        $modelo = htmlspecialchars($_POST['modelo']);
        $anio = filter_var($_POST['anio'], FILTER_SANITIZE_NUMBER_INT);
        $matricula = htmlspecialchars($_POST['matricula']);
        $estado = htmlspecialchars($_POST['estado']);
        $precio_dia = filter_var($_POST['precio_dia'], FILTER_VALIDATE_FLOAT);
        $socio = htmlspecialchars($_POST['socio']);
        $codig = $_POST['codig']; // Gama numérica

        // Manejo de la imagen subida
        $directorio = "imagenes_vehiculos/"; // Carpeta donde se guardarán las imágenes

        // Verificar si la carpeta existe, si no, crearla
        if (!is_dir($directorio)) {
            mkdir($directorio, 0777, true);
        }

        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $imagenNombre = basename($_FILES['imagen']['name']);
            $rutaImagen = $directorio . $imagenNombre;

            // Mover la imagen a la carpeta
            if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $rutaImagen)) {
                echo "<p>Imagen subida correctamente.</p>";
            } else {
                echo "<p>Error al subir la imagen.</p>";
                exit;
            }
        } else {
            echo "<p>Error: No se pudo subir la imagen.</p>";
            exit;
        }

        // Insertar los datos en la base de datos
        $sql = "INSERT INTO vehiculos (marca, modelo, anio, matricula, estado, precio_dia, cedula, codig, imagen) 
                VALUES (:marca, :modelo, :anio, :matricula, :estado, :precio_dia, :cedula, :codig, :imagen)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':marca', $marca);
        $stmt->bindParam(':modelo', $modelo);
        $stmt->bindParam(':anio', $anio, PDO::PARAM_INT);
        $stmt->bindParam(':matricula', $matricula);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':precio_dia', $precio_dia);
        $stmt->bindParam(':cedula', $socio);
        $stmt->bindParam(':codig', $codig, PDO::PARAM_INT);
        $stmt->bindParam(':imagen', $rutaImagen);
        $stmt->execute();

        echo "<p>Vehículo registrado exitosamente con imagen.</p>";
    } catch (PDOException $e) {
        echo "<p>Error en la base de datos: " . $e->getMessage() . "</p>";
    }

    // Cerrar la conexión
    $conn = null;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Vehículo</title>
    <style>
        /* Estilo general */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            text-align: center;
        }

        h1 {
            color: #007BFF;
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        /* Estilos para el formulario */
        .form-container {
            background-color: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            display: inline-block;
            max-width: 400px;
            width: 100%;
            text-align: left;
        }

        label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
            color: #333;
        }

        input, select {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border: 2px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            transition: 0.3s;
        }

        input:focus, select:focus {
            border-color: #007BFF;
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #007BFF;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            font-weight: bold;
            margin-top: 10px;
            transition: 0.3s;
        }

        button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        /* Estilos responsivos */
        @media (max-width: 768px) {
            .form-container {
                width: 90%;
            }
        }
    </style>
</head>
<body>

    <h1>Registrar Vehículo</h1>

    <div class="form-container">
        <form method="POST" action="" enctype="multipart/form-data">
            <label for="nombre_archivo">Nombre del Nuevo Vehiculo:</label>
            <input type="text" id="nombre_archivo" name="nombre_archivo" required>

            <label for="marca">Marca:</label>
            <input type="text" id="marca" name="marca" required>

            <label for="modelo">Modelo:</label>
            <input type="text" id="modelo" name="modelo" required>

            <label for="anio">Año:</label>
            <input type="number" id="anio" name="anio" required>

            <label for="matricula">Matrícula:</label>
            <input type="text" id="matricula" name="matricula" required>

            <label for="estado">Estado:</label>
            <select id="estado" name="estado" required>
                <option value="disponible">Disponible</option>
                <option value="reservado">Reservado</option>
                <option value="mantenimiento">Mantenimiento</option>
                <option value="ocupado">Ocupado</option>
            </select>

            <label for="precio_dia">Precio por Día:</label>
            <input type="number" id="precio_dia" name="precio_dia" step="0.01" required>

            <label for="socio">ID Socio:</label>
            <input type="text" id="socio" name="socio" required>

            <label for="codig">Gama:</label>
            <select id="codig" name="codig" required>
                <option value="3">Familiar</option>
            </select>

            <label for="imagen">Imagen del Vehículo:</label>
            <input type="file" id="imagen" name="imagen" accept="image/*" required>

            <button type="submit">Registrar Vehículo</button>
            <a href="GAMA_FAMI.php">Ver vehículos</a>
        </form>
    </div>

</body>
</html>
=======
<<<<<<< HEAD
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Definir los parámetros de conexión a la base de datos
    $host = 'localhost';
    $dbname = 'FAZ_CAR_QUEVEDO2';
    $username = 'sa';
    $pasword = '12345678';
    $puerto = 1433;

    try {
        // Conectar a la base de datos con PDO
        $conn = new PDO("sqlsrv:Server=$host,$puerto;Database=$dbname", $username, $pasword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Recibir y validar datos del formulario
        $nombreArchivo = htmlspecialchars($_POST['nombre_archivo']);
        $marca = htmlspecialchars($_POST['marca']);
        $modelo = htmlspecialchars($_POST['modelo']);
        $anio = filter_var($_POST['anio'], FILTER_SANITIZE_NUMBER_INT);
        $matricula = htmlspecialchars($_POST['matricula']);
        $estado = htmlspecialchars($_POST['estado']);
        $precio_dia = filter_var($_POST['precio_dia'], FILTER_VALIDATE_FLOAT);
        $socio = htmlspecialchars($_POST['socio']);
        $codig = $_POST['codig']; // Gama numérica

        // Manejo de la imagen subida
        $directorio = "imagenes_vehiculos/"; // Carpeta donde se guardarán las imágenes

        // Verificar si la carpeta existe, si no, crearla
        if (!is_dir($directorio)) {
            mkdir($directorio, 0777, true);
        }

        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $imagenNombre = basename($_FILES['imagen']['name']);
            $rutaImagen = $directorio . $imagenNombre;

            // Mover la imagen a la carpeta
            if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $rutaImagen)) {
                echo "<p>Imagen subida correctamente.</p>";
            } else {
                echo "<p>Error al subir la imagen.</p>";
                exit;
            }
        } else {
            echo "<p>Error: No se pudo subir la imagen.</p>";
            exit;
        }

        // Insertar los datos en la base de datos
        $sql = "INSERT INTO vehiculos (marca, modelo, anio, matricula, estado, precio_dia, cedula, codig, imagen) 
                VALUES (:marca, :modelo, :anio, :matricula, :estado, :precio_dia, :cedula, :codig, :imagen)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':marca', $marca);
        $stmt->bindParam(':modelo', $modelo);
        $stmt->bindParam(':anio', $anio, PDO::PARAM_INT);
        $stmt->bindParam(':matricula', $matricula);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':precio_dia', $precio_dia);
        $stmt->bindParam(':cedula', $socio);
        $stmt->bindParam(':codig', $codig, PDO::PARAM_INT);
        $stmt->bindParam(':imagen', $rutaImagen);
        $stmt->execute();

        echo "<p>Vehículo registrado exitosamente con imagen.</p>";
    } catch (PDOException $e) {
        echo "<p>Error en la base de datos: " . $e->getMessage() . "</p>";
    }

    // Cerrar la conexión
    $conn = null;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Vehículo</title>
    <style>
        /* Estilo general */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            text-align: center;
        }

        h1 {
            color: #007BFF;
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        /* Estilos para el formulario */
        .form-container {
            background-color: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            display: inline-block;
            max-width: 400px;
            width: 100%;
            text-align: left;
        }

        label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
            color: #333;
        }

        input, select {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border: 2px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            transition: 0.3s;
        }

        input:focus, select:focus {
            border-color: #007BFF;
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #007BFF;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            font-weight: bold;
            margin-top: 10px;
            transition: 0.3s;
        }

        button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        /* Estilos responsivos */
        @media (max-width: 768px) {
            .form-container {
                width: 90%;
            }
        }
    </style>
</head>
<body>

    <h1>Registrar Vehículo</h1>

    <div class="form-container">
        <form method="POST" action="" enctype="multipart/form-data">
            <label for="nombre_archivo">Nombre del Nuevo Vehiculo:</label>
            <input type="text" id="nombre_archivo" name="nombre_archivo" required>

            <label for="marca">Marca:</label>
            <input type="text" id="marca" name="marca" required>

            <label for="modelo">Modelo:</label>
            <input type="text" id="modelo" name="modelo" required>

            <label for="anio">Año:</label>
            <input type="number" id="anio" name="anio" required>

            <label for="matricula">Matrícula:</label>
            <input type="text" id="matricula" name="matricula" required>

            <label for="estado">Estado:</label>
            <select id="estado" name="estado" required>
                <option value="disponible">Disponible</option>
                <option value="reservado">Reservado</option>
                <option value="mantenimiento">Mantenimiento</option>
                <option value="ocupado">Ocupado</option>
            </select>

            <label for="precio_dia">Precio por Día:</label>
            <input type="number" id="precio_dia" name="precio_dia" step="0.01" required>

            <label for="socio">ID Socio:</label>
            <input type="text" id="socio" name="socio" required>

            <label for="codig">Gama:</label>
            <select id="codig" name="codig" required>
                <option value="3">Familiar</option>
            </select>

            <label for="imagen">Imagen del Vehículo:</label>
            <input type="file" id="imagen" name="imagen" accept="image/*" required>

            <button type="submit">Registrar Vehículo</button>
            <a href="GAMA_FAMI.php">Ver vehículos</a>
        </form>
    </div>

</body>
</html>
=======
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Definir los parámetros de conexión a la base de datos
    $host = 'localhost';
    $dbname = 'FAZ_CAR_QUEVEDO2';
    $username = 'sa';
    $pasword = '12345678';
    $puerto = 1433;

    try {
        // Conectar a la base de datos con PDO
        $conn = new PDO("sqlsrv:Server=$host,$puerto;Database=$dbname", $username, $pasword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Recibir y validar datos del formulario
        $nombreArchivo = htmlspecialchars($_POST['nombre_archivo']);
        $marca = htmlspecialchars($_POST['marca']);
        $modelo = htmlspecialchars($_POST['modelo']);
        $anio = filter_var($_POST['anio'], FILTER_SANITIZE_NUMBER_INT);
        $matricula = htmlspecialchars($_POST['matricula']);
        $estado = htmlspecialchars($_POST['estado']);
        $precio_dia = filter_var($_POST['precio_dia'], FILTER_VALIDATE_FLOAT);
        $socio = htmlspecialchars($_POST['socio']);
        $codig = $_POST['codig']; // Gama numérica

        // Manejo de la imagen subida
        $directorio = "imagenes_vehiculos/"; // Carpeta donde se guardarán las imágenes

        // Verificar si la carpeta existe, si no, crearla
        if (!is_dir($directorio)) {
            mkdir($directorio, 0777, true);
        }

        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $imagenNombre = basename($_FILES['imagen']['name']);
            $rutaImagen = $directorio . $imagenNombre;

            // Mover la imagen a la carpeta
            if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $rutaImagen)) {
                echo "<p>Imagen subida correctamente.</p>";
            } else {
                echo "<p>Error al subir la imagen.</p>";
                exit;
            }
        } else {
            echo "<p>Error: No se pudo subir la imagen.</p>";
            exit;
        }

        // Insertar los datos en la base de datos
        $sql = "INSERT INTO vehiculos (marca, modelo, anio, matricula, estado, precio_dia, cedula, codig, imagen) 
                VALUES (:marca, :modelo, :anio, :matricula, :estado, :precio_dia, :cedula, :codig, :imagen)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':marca', $marca);
        $stmt->bindParam(':modelo', $modelo);
        $stmt->bindParam(':anio', $anio, PDO::PARAM_INT);
        $stmt->bindParam(':matricula', $matricula);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':precio_dia', $precio_dia);
        $stmt->bindParam(':cedula', $socio);
        $stmt->bindParam(':codig', $codig, PDO::PARAM_INT);
        $stmt->bindParam(':imagen', $rutaImagen);
        $stmt->execute();

        echo "<p>Vehículo registrado exitosamente con imagen.</p>";
    } catch (PDOException $e) {
        echo "<p>Error en la base de datos: " . $e->getMessage() . "</p>";
    }

    // Cerrar la conexión
    $conn = null;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Vehículo</title>
    <style>
        /* Estilo general */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            text-align: center;
        }

        h1 {
            color: #007BFF;
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        /* Estilos para el formulario */
        .form-container {
            background-color: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            display: inline-block;
            max-width: 400px;
            width: 100%;
            text-align: left;
        }

        label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
            color: #333;
        }

        input, select {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border: 2px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            transition: 0.3s;
        }

        input:focus, select:focus {
            border-color: #007BFF;
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #007BFF;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            font-weight: bold;
            margin-top: 10px;
            transition: 0.3s;
        }

        button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        /* Estilos responsivos */
        @media (max-width: 768px) {
            .form-container {
                width: 90%;
            }
        }
    </style>
</head>
<body>

    <h1>Registrar Vehículo</h1>

    <div class="form-container">
        <form method="POST" action="" enctype="multipart/form-data">
            <label for="nombre_archivo">Nombre del Nuevo Vehiculo:</label>
            <input type="text" id="nombre_archivo" name="nombre_archivo" required>

            <label for="marca">Marca:</label>
            <input type="text" id="marca" name="marca" required>

            <label for="modelo">Modelo:</label>
            <input type="text" id="modelo" name="modelo" required>

            <label for="anio">Año:</label>
            <input type="number" id="anio" name="anio" required>

            <label for="matricula">Matrícula:</label>
            <input type="text" id="matricula" name="matricula" required>

            <label for="estado">Estado:</label>
            <select id="estado" name="estado" required>
                <option value="disponible">Disponible</option>
                <option value="reservado">Reservado</option>
                <option value="mantenimiento">Mantenimiento</option>
                <option value="ocupado">Ocupado</option>
            </select>

            <label for="precio_dia">Precio por Día:</label>
            <input type="number" id="precio_dia" name="precio_dia" step="0.01" required>

            <label for="socio">ID Socio:</label>
            <input type="text" id="socio" name="socio" required>

            <label for="codig">Gama:</label>
            <select id="codig" name="codig" required>
                <option value="3">Familiar</option>
            </select>

            <label for="imagen">Imagen del Vehículo:</label>
            <input type="file" id="imagen" name="imagen" accept="image/*" required>

            <button type="submit">Registrar Vehículo</button>
            <a href="GAMA_FAMI.php">Ver vehículos</a>
        </form>
    </div>

</body>
</html>
>>>>>>> 3b36bcf60ef3352292526c56cd1c2a3d013545b5
>>>>>>> 385b4c70925897719a0be7311cee9ece92ce7643
