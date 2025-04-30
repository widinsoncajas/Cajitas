<<<<<<< HEAD
<?php
include_once("conexion.php");

// Crear una instancia de la conexión
$conexion = Cconexion::ConexionBD();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'] ?? null;
    $contrasena = $_POST['contrasena'] ?? null;

    if ($usuario && $contrasena) {
        try {
            // Preparar la consulta SQL
            $sql = "SELECT * FROM usuario WHERE nombre = ? AND contraseña = ?";
            $stmt = $conexion->prepare($sql);

            // Ejecutar la declaración con los parámetros
            $stmt->execute([$usuario, $contrasena]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // Usuario autenticado exitosamente
                echo "<script>
                    alert('Ingreso autorizado');
                    window.location.href = 'inicio.php';
                </script>";
            } else {
                // Si las credenciales no coinciden con un usuario registrado, verificar las credenciales administrativas
                $usuario_correcto = "administrador";
                $contrasena_correcta = "12345";

                if ($usuario === $usuario_correcto && $contrasena === $contrasena_correcta) {
                    // Credenciales administrativas correctas
                    echo "<script>
                        alert('Ingreso autorizado');
                        window.location.href = 'inicio.php';
                    </script>";
                } else {
                    // Credenciales incorrectas
                    echo "<script>
                        alert('Usuario o contraseña incorrectos');
                        window.history.back();
                    </script>";
                }
            }
        } catch (PDOException $e) {
            // Manejo de errores en la consulta
            echo "Error en la consulta: " . $e->getMessage();
        }
    } else {
        echo "<script>alert('Por favor, complete todos los campos'); window.history.back();</script>";
    }
}
?>
=======
<<<<<<< HEAD
<?php
include_once("conexion.php");

// Crear una instancia de la conexión
$conexion = Cconexion::ConexionBD();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'] ?? null;
    $contrasena = $_POST['contrasena'] ?? null;

    if ($usuario && $contrasena) {
        try {
            // Preparar la consulta SQL
            $sql = "SELECT * FROM usuario WHERE nombre = ? AND contraseña = ?";
            $stmt = $conexion->prepare($sql);

            // Ejecutar la declaración con los parámetros
            $stmt->execute([$usuario, $contrasena]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // Usuario autenticado exitosamente
                echo "<script>
                    alert('Ingreso autorizado');
                    window.location.href = 'inicio.php';
                </script>";
            } else {
                // Si las credenciales no coinciden con un usuario registrado, verificar las credenciales administrativas
                $usuario_correcto = "administrador";
                $contrasena_correcta = "12345";

                if ($usuario === $usuario_correcto && $contrasena === $contrasena_correcta) {
                    // Credenciales administrativas correctas
                    echo "<script>
                        alert('Ingreso autorizado');
                        window.location.href = 'inicio.php';
                    </script>";
                } else {
                    // Credenciales incorrectas
                    echo "<script>
                        alert('Usuario o contraseña incorrectos');
                        window.history.back();
                    </script>";
                }
            }
        } catch (PDOException $e) {
            // Manejo de errores en la consulta
            echo "Error en la consulta: " . $e->getMessage();
        }
    } else {
        echo "<script>alert('Por favor, complete todos los campos'); window.history.back();</script>";
    }
}
?>
=======
<?php
include_once("conexion.php");

// Crear una instancia de la conexión
$conexion = Cconexion::ConexionBD();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'] ?? null;
    $contrasena = $_POST['contrasena'] ?? null;

    if ($usuario && $contrasena) {
        try {
            // Preparar la consulta SQL
            $sql = "SELECT * FROM usuario WHERE nombre = ? AND contraseña = ?";
            $stmt = $conexion->prepare($sql);

            // Ejecutar la declaración con los parámetros
            $stmt->execute([$usuario, $contrasena]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // Usuario autenticado exitosamente
                echo "<script>
                    alert('Ingreso autorizado');
                    window.location.href = 'inicio.php';
                </script>";
            } else {
                // Si las credenciales no coinciden con un usuario registrado, verificar las credenciales administrativas
                $usuario_correcto = "administrador";
                $contrasena_correcta = "12345";

                if ($usuario === $usuario_correcto && $contrasena === $contrasena_correcta) {
                    // Credenciales administrativas correctas
                    echo "<script>
                        alert('Ingreso autorizado');
                        window.location.href = 'inicio.php';
                    </script>";
                } else {
                    // Credenciales incorrectas
                    echo "<script>
                        alert('Usuario o contraseña incorrectos');
                        window.history.back();
                    </script>";
                }
            }
        } catch (PDOException $e) {
            // Manejo de errores en la consulta
            echo "Error en la consulta: " . $e->getMessage();
        }
    } else {
        echo "<script>alert('Por favor, complete todos los campos'); window.history.back();</script>";
    }
}
?>
>>>>>>> 3b36bcf60ef3352292526c56cd1c2a3d013545b5
>>>>>>> 385b4c70925897719a0be7311cee9ece92ce7643
