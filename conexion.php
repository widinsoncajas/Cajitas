<?php

class Conexion {
    public static function ConexionBD() {
        $host = 'localhost';
        $dbname = 'FAZ_CAR_QUEVEDO2';
        $username = 'sa';
        $password = '12345678';
        $puerto = 1433;

        try {
            // Crear una instancia PDO para conectar a la base de datos
            $conn = new PDO("sqlsrv:Server=$host,$puerto;Database=$dbname", $username, $password);
            // Establecer el modo de error de PDO
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Opcional: Comenté el echo para no interrumpir el flujo
            // echo "CONECTADO";

        } catch (PDOException $exp) {
            // Muestra un mensaje detallado en caso de error
            echo "No se pudo conectar a la base de datos $dbname, error: " . $exp->getMessage();
            return null;
        }
        return $conn;
    }
}

