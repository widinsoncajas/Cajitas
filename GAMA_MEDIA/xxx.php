<<<<<<< HEAD
<?php
// Incluir archivo de conexión
include_once("conexion.php");

try {
    // Crear conexión a la base de datos
    $conexion = Cconexion::ConexionBD();

    // Consulta mejorada para mostrar datos completos
    $consulta_sql = "
        SELECT 
            r.id_reservacion,
            c.nombre AS cliente_nombre,
            c.cedula,
            v.marca AS vehiculo_marca,
            r.fecha_inicio,
            r.fecha_fin,
            r.estado
        FROM reservaciones r
        INNER JOIN clientes c ON r.cedula = c.cedula
        INNER JOIN vehiculos v ON r.id_vehiculo = v.id_vehiculo
    ";

    $consulta_stmt = $conexion->prepare($consulta_sql);
    $consulta_stmt->execute();
    $reservaciones = $consulta_stmt->fetchAll(PDO::FETCH_ASSOC);

    // Verificar si hay resultados
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Reservaciones Registradas</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f9;
                color: #333;
                margin: 0;
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
                color: #fff;
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
            .no-data {
                text-align: center;
                font-size: 18px;
                color: #555;
            }
        </style>
    </head>
    <body>";

    if ($reservaciones) {
        // Mostrar los resultados en una tabla
        echo "<h1>Reservaciones Registradas</h1>";
        echo "<table>";
        echo "<thead>
                <tr>
                    <th>ID Reservación</th>
                    <th>Nombre del Cliente</th>
                    <th>Cédula</th>
                    <th>Marca del Vehículo</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Estado</th>
                </tr>
              </thead>";
        echo "<tbody>";
        foreach ($reservaciones as $reservacion) {
            echo "<tr>
                    <td>" . htmlspecialchars($reservacion['id_reservacion']) . "</td>
                    <td>" . htmlspecialchars($reservacion['cliente_nombre']) . "</td>
                    <td>" . htmlspecialchars($reservacion['cedula']) . "</td>
                    <td>" . htmlspecialchars($reservacion['vehiculo_marca']) . "</td>
                    <td>" . htmlspecialchars($reservacion['fecha_inicio']) . "</td>
                    <td>" . htmlspecialchars($reservacion['fecha_fin']) . "</td>
                    <td>" . htmlspecialchars($reservacion['estado']) . "</td>
                  </tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<h1 class='no-data'>No hay reservaciones registradas.</h1>";
    }

    echo "</body></html>";
} catch (PDOException $e) {
    // Mostrar error detallado
    echo "<p style='color: red;'>Error en la conexión o consulta en el archivo: " . $e->getFile() . 
         " en la línea: " . $e->getLine() . 
         ". Detalles: " . $e->getMessage() . "</p>";
}
?>
=======
<<<<<<< HEAD
<?php
// Incluir archivo de conexión
include_once("conexion.php");

try {
    // Crear conexión a la base de datos
    $conexion = Cconexion::ConexionBD();

    // Consulta mejorada para mostrar datos completos
    $consulta_sql = "
        SELECT 
            r.id_reservacion,
            c.nombre AS cliente_nombre,
            c.cedula,
            v.marca AS vehiculo_marca,
            r.fecha_inicio,
            r.fecha_fin,
            r.estado
        FROM reservaciones r
        INNER JOIN clientes c ON r.cedula = c.cedula
        INNER JOIN vehiculos v ON r.id_vehiculo = v.id_vehiculo
    ";

    $consulta_stmt = $conexion->prepare($consulta_sql);
    $consulta_stmt->execute();
    $reservaciones = $consulta_stmt->fetchAll(PDO::FETCH_ASSOC);

    // Verificar si hay resultados
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Reservaciones Registradas</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f9;
                color: #333;
                margin: 0;
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
                color: #fff;
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
            .no-data {
                text-align: center;
                font-size: 18px;
                color: #555;
            }
        </style>
    </head>
    <body>";

    if ($reservaciones) {
        // Mostrar los resultados en una tabla
        echo "<h1>Reservaciones Registradas</h1>";
        echo "<table>";
        echo "<thead>
                <tr>
                    <th>ID Reservación</th>
                    <th>Nombre del Cliente</th>
                    <th>Cédula</th>
                    <th>Marca del Vehículo</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Estado</th>
                </tr>
              </thead>";
        echo "<tbody>";
        foreach ($reservaciones as $reservacion) {
            echo "<tr>
                    <td>" . htmlspecialchars($reservacion['id_reservacion']) . "</td>
                    <td>" . htmlspecialchars($reservacion['cliente_nombre']) . "</td>
                    <td>" . htmlspecialchars($reservacion['cedula']) . "</td>
                    <td>" . htmlspecialchars($reservacion['vehiculo_marca']) . "</td>
                    <td>" . htmlspecialchars($reservacion['fecha_inicio']) . "</td>
                    <td>" . htmlspecialchars($reservacion['fecha_fin']) . "</td>
                    <td>" . htmlspecialchars($reservacion['estado']) . "</td>
                  </tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<h1 class='no-data'>No hay reservaciones registradas.</h1>";
    }

    echo "</body></html>";
} catch (PDOException $e) {
    // Mostrar error detallado
    echo "<p style='color: red;'>Error en la conexión o consulta en el archivo: " . $e->getFile() . 
         " en la línea: " . $e->getLine() . 
         ". Detalles: " . $e->getMessage() . "</p>";
}
?>
=======
<?php
// Incluir archivo de conexión
include_once("conexion.php");

try {
    // Crear conexión a la base de datos
    $conexion = Cconexion::ConexionBD();

    // Consulta mejorada para mostrar datos completos
    $consulta_sql = "
        SELECT 
            r.id_reservacion,
            c.nombre AS cliente_nombre,
            c.cedula,
            v.marca AS vehiculo_marca,
            r.fecha_inicio,
            r.fecha_fin,
            r.estado
        FROM reservaciones r
        INNER JOIN clientes c ON r.cedula = c.cedula
        INNER JOIN vehiculos v ON r.id_vehiculo = v.id_vehiculo
    ";

    $consulta_stmt = $conexion->prepare($consulta_sql);
    $consulta_stmt->execute();
    $reservaciones = $consulta_stmt->fetchAll(PDO::FETCH_ASSOC);

    // Verificar si hay resultados
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Reservaciones Registradas</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f9;
                color: #333;
                margin: 0;
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
                color: #fff;
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
            .no-data {
                text-align: center;
                font-size: 18px;
                color: #555;
            }
        </style>
    </head>
    <body>";

    if ($reservaciones) {
        // Mostrar los resultados en una tabla
        echo "<h1>Reservaciones Registradas</h1>";
        echo "<table>";
        echo "<thead>
                <tr>
                    <th>ID Reservación</th>
                    <th>Nombre del Cliente</th>
                    <th>Cédula</th>
                    <th>Marca del Vehículo</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Estado</th>
                </tr>
              </thead>";
        echo "<tbody>";
        foreach ($reservaciones as $reservacion) {
            echo "<tr>
                    <td>" . htmlspecialchars($reservacion['id_reservacion']) . "</td>
                    <td>" . htmlspecialchars($reservacion['cliente_nombre']) . "</td>
                    <td>" . htmlspecialchars($reservacion['cedula']) . "</td>
                    <td>" . htmlspecialchars($reservacion['vehiculo_marca']) . "</td>
                    <td>" . htmlspecialchars($reservacion['fecha_inicio']) . "</td>
                    <td>" . htmlspecialchars($reservacion['fecha_fin']) . "</td>
                    <td>" . htmlspecialchars($reservacion['estado']) . "</td>
                  </tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<h1 class='no-data'>No hay reservaciones registradas.</h1>";
    }

    echo "</body></html>";
} catch (PDOException $e) {
    // Mostrar error detallado
    echo "<p style='color: red;'>Error en la conexión o consulta en el archivo: " . $e->getFile() . 
         " en la línea: " . $e->getLine() . 
         ". Detalles: " . $e->getMessage() . "</p>";
}
?>
>>>>>>> 3b36bcf60ef3352292526c56cd1c2a3d013545b5
>>>>>>> 385b4c70925897719a0be7311cee9ece92ce7643
