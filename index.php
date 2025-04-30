<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conexión con PHP Server</title>
</head>
<body>
    <?php
    // Incluir el archivo que contiene la clase de conexión
    include_once("conexion.php");

    // Realizar la conexión a la base de datos y obtener el objeto de conexión
    $conn = Cconexion::ConexionBD();

    // Verificar si la conexión fue exitosa
    if ($conn) {
        echo "<p>Conexión exitosa a la base de datos.</p>";
    } else {
        echo "<p>Error al conectar a la base de datos.</p>";
    }
    ?>
</body>
</html>
