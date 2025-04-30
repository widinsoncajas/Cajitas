<<<<<<< HEAD
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Definir los parámetros de conexión a la base de datos
    $host='localhost';
        $dbname='FAZ_CAR_QUEVEDO2';
        $username='sa';
        $pasword='12345678';
        $puerto= 1433;

    try {
        // Conectar a la base de datos con PDO
        $conn= new PDO("sqlsrv:Server=$host,$puerto;Database=$dbname",$username,$pasword);
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

        // Verificar que todos los campos estén completos y válidos
        if (
            empty($nombreArchivo) || empty($marca) || empty($modelo) ||
            empty($anio) || empty($matricula) || empty($estado) ||
            $precio_dia === false || empty($socio)
        ) {
            echo "<p>Error: Todos los campos son obligatorios y deben ser válidos.</p>";
            exit;
        }

        // 1. Guardar los datos en la base de datos
        $sql = "INSERT INTO vehiculos (marca, modelo, anio, matricula, estado, precio_dia, id_socio) 
                VALUES (:marca, :modelo, :anio, :matricula, :estado, :precio_dia, :id_socio)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':marca', $marca);
        $stmt->bindParam(':modelo', $modelo);
        $stmt->bindParam(':anio', $anio, PDO::PARAM_INT);
        $stmt->bindParam(':matricula', $matricula);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':precio_dia', $precio_dia);
        $stmt->bindParam(':id_socio', $socio);
        $stmt->execute();

        echo "<p>Vehículo registrado exitosamente en la base de datos.</p>";

        // 2. Crear el archivo PHP con los datos
        if (pathinfo($nombreArchivo, PATHINFO_EXTENSION) !== 'php') {
            $nombreArchivo .= '.php';
        }

        // Sanitizar el nombre del archivo para permitir solo caracteres válidos
        $nombreArchivo = preg_replace('/[^a-zA-Z0-9_]/', '', pathinfo($nombreArchivo, PATHINFO_FILENAME)) . '.php';

        // Crear contenido PHP del archivo
        $phpContent = <<<PHP
<?php
// Datos del vehículo
\$vehiculo = [
    'marca' => '$marca',
    'modelo' => '$modelo',
    'anio' => $anio,
    'matricula' => '$matricula',
    'estado' => '$estado',
    'precio_dia' => $precio_dia,
    'socio' => '$socio',
];

// Imprimir los datos del vehículo
print_r(\$vehiculo);
?>
PHP;

        $filePath = __DIR__ . '/' . $nombreArchivo;

        // Crear el archivo PHP en el servidor
        if (file_put_contents($filePath, $phpContent)) {
            echo "<p>Archivo <strong>$nombreArchivo</strong> creado exitosamente en el servidor.</p>";
        } else {
            echo "<p>Error al crear el archivo.</p>";
        }
    } catch (PDOException $e) {
        // Mostrar información detallada del error
        echo "<p><strong>Error al conectar o guardar en la base de datos:</strong></p>";
        echo "<p><strong>Código de error:</strong> " . $e->getCode() . "</p>";
        echo "<p><strong>Mensaje:</strong> " . $e->getMessage() . "</p>";
        echo "<p><strong>Archivo:</strong> " . $e->getFile() . "</p>";
        echo "<p><strong>Línea:</strong> " . $e->getLine() . "</p>";
    }

    // Cerrar la conexión
    $conn = null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Vehículo y Crear Archivo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        h1 {
            text-align: center;
            font-size: 22px;
            color: #333;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }
        input, select, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Registrar Vehículo</h1>
        <form method="POST" action="">
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

            <button type="submit">Registrar Vehículo</button>
        </form>
    </div>
</body>
</html>
=======
<<<<<<< HEAD
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Definir los parámetros de conexión a la base de datos
    $host='localhost';
        $dbname='FAZ_CAR_QUEVEDO2';
        $username='sa';
        $pasword='12345678';
        $puerto= 1433;

    try {
        // Conectar a la base de datos con PDO
        $conn= new PDO("sqlsrv:Server=$host,$puerto;Database=$dbname",$username,$pasword);
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

        // Verificar que todos los campos estén completos y válidos
        if (
            empty($nombreArchivo) || empty($marca) || empty($modelo) ||
            empty($anio) || empty($matricula) || empty($estado) ||
            $precio_dia === false || empty($socio)
        ) {
            echo "<p>Error: Todos los campos son obligatorios y deben ser válidos.</p>";
            exit;
        }

        // 1. Guardar los datos en la base de datos
        $sql = "INSERT INTO vehiculos (marca, modelo, anio, matricula, estado, precio_dia, id_socio) 
                VALUES (:marca, :modelo, :anio, :matricula, :estado, :precio_dia, :id_socio)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':marca', $marca);
        $stmt->bindParam(':modelo', $modelo);
        $stmt->bindParam(':anio', $anio, PDO::PARAM_INT);
        $stmt->bindParam(':matricula', $matricula);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':precio_dia', $precio_dia);
        $stmt->bindParam(':id_socio', $socio);
        $stmt->execute();

        echo "<p>Vehículo registrado exitosamente en la base de datos.</p>";

        // 2. Crear el archivo PHP con los datos
        if (pathinfo($nombreArchivo, PATHINFO_EXTENSION) !== 'php') {
            $nombreArchivo .= '.php';
        }

        // Sanitizar el nombre del archivo para permitir solo caracteres válidos
        $nombreArchivo = preg_replace('/[^a-zA-Z0-9_]/', '', pathinfo($nombreArchivo, PATHINFO_FILENAME)) . '.php';

        // Crear contenido PHP del archivo
        $phpContent = <<<PHP
<?php
// Datos del vehículo
\$vehiculo = [
    'marca' => '$marca',
    'modelo' => '$modelo',
    'anio' => $anio,
    'matricula' => '$matricula',
    'estado' => '$estado',
    'precio_dia' => $precio_dia,
    'socio' => '$socio',
];

// Imprimir los datos del vehículo
print_r(\$vehiculo);
?>
PHP;

        $filePath = __DIR__ . '/' . $nombreArchivo;

        // Crear el archivo PHP en el servidor
        if (file_put_contents($filePath, $phpContent)) {
            echo "<p>Archivo <strong>$nombreArchivo</strong> creado exitosamente en el servidor.</p>";
        } else {
            echo "<p>Error al crear el archivo.</p>";
        }
    } catch (PDOException $e) {
        // Mostrar información detallada del error
        echo "<p><strong>Error al conectar o guardar en la base de datos:</strong></p>";
        echo "<p><strong>Código de error:</strong> " . $e->getCode() . "</p>";
        echo "<p><strong>Mensaje:</strong> " . $e->getMessage() . "</p>";
        echo "<p><strong>Archivo:</strong> " . $e->getFile() . "</p>";
        echo "<p><strong>Línea:</strong> " . $e->getLine() . "</p>";
    }

    // Cerrar la conexión
    $conn = null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Vehículo y Crear Archivo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        h1 {
            text-align: center;
            font-size: 22px;
            color: #333;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }
        input, select, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Registrar Vehículo</h1>
        <form method="POST" action="">
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

            <button type="submit">Registrar Vehículo</button>
        </form>
    </div>
</body>
</html>
=======
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Definir los parámetros de conexión a la base de datos
    $host='localhost';
        $dbname='FAZ_CAR_QUEVEDO2';
        $username='sa';
        $pasword='12345678';
        $puerto= 1433;

    try {
        // Conectar a la base de datos con PDO
        $conn= new PDO("sqlsrv:Server=$host,$puerto;Database=$dbname",$username,$pasword);
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

        // Verificar que todos los campos estén completos y válidos
        if (
            empty($nombreArchivo) || empty($marca) || empty($modelo) ||
            empty($anio) || empty($matricula) || empty($estado) ||
            $precio_dia === false || empty($socio)
        ) {
            echo "<p>Error: Todos los campos son obligatorios y deben ser válidos.</p>";
            exit;
        }

        // 1. Guardar los datos en la base de datos
        $sql = "INSERT INTO vehiculos (marca, modelo, anio, matricula, estado, precio_dia, id_socio) 
                VALUES (:marca, :modelo, :anio, :matricula, :estado, :precio_dia, :id_socio)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':marca', $marca);
        $stmt->bindParam(':modelo', $modelo);
        $stmt->bindParam(':anio', $anio, PDO::PARAM_INT);
        $stmt->bindParam(':matricula', $matricula);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':precio_dia', $precio_dia);
        $stmt->bindParam(':id_socio', $socio);
        $stmt->execute();

        echo "<p>Vehículo registrado exitosamente en la base de datos.</p>";

        // 2. Crear el archivo PHP con los datos
        if (pathinfo($nombreArchivo, PATHINFO_EXTENSION) !== 'php') {
            $nombreArchivo .= '.php';
        }

        // Sanitizar el nombre del archivo para permitir solo caracteres válidos
        $nombreArchivo = preg_replace('/[^a-zA-Z0-9_]/', '', pathinfo($nombreArchivo, PATHINFO_FILENAME)) . '.php';

        // Crear contenido PHP del archivo
        $phpContent = <<<PHP
<?php
// Datos del vehículo
\$vehiculo = [
    'marca' => '$marca',
    'modelo' => '$modelo',
    'anio' => $anio,
    'matricula' => '$matricula',
    'estado' => '$estado',
    'precio_dia' => $precio_dia,
    'socio' => '$socio',
];

// Imprimir los datos del vehículo
print_r(\$vehiculo);
?>
PHP;

        $filePath = __DIR__ . '/' . $nombreArchivo;

        // Crear el archivo PHP en el servidor
        if (file_put_contents($filePath, $phpContent)) {
            echo "<p>Archivo <strong>$nombreArchivo</strong> creado exitosamente en el servidor.</p>";
        } else {
            echo "<p>Error al crear el archivo.</p>";
        }
    } catch (PDOException $e) {
        // Mostrar información detallada del error
        echo "<p><strong>Error al conectar o guardar en la base de datos:</strong></p>";
        echo "<p><strong>Código de error:</strong> " . $e->getCode() . "</p>";
        echo "<p><strong>Mensaje:</strong> " . $e->getMessage() . "</p>";
        echo "<p><strong>Archivo:</strong> " . $e->getFile() . "</p>";
        echo "<p><strong>Línea:</strong> " . $e->getLine() . "</p>";
    }

    // Cerrar la conexión
    $conn = null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Vehículo y Crear Archivo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        h1 {
            text-align: center;
            font-size: 22px;
            color: #333;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }
        input, select, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Registrar Vehículo</h1>
        <form method="POST" action="">
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

            <button type="submit">Registrar Vehículo</button>
        </form>
    </div>
</body>
</html>
>>>>>>> 3b36bcf60ef3352292526c56cd1c2a3d013545b5
>>>>>>> 385b4c70925897719a0be7311cee9ece92ce7643
