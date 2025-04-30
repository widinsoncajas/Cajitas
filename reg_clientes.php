
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Cliente</title>
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
        input, textarea, button {
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
        <h1>Registro de Cliente</h1>
        <form id="registroForm" action="reg_clientes_raptor.php" method="POST">
        <label for="cedula">Cédula:</label>
        <input type="text" id="cedula" name="cedula" required 
       pattern="\d{10}" maxlength="10" title="Debe ingresar exactamente 10 dígitos">

       <label for="nombre">Nombre:</label>
       <input type="text" id="nombre" name="nombre" required 
       pattern="[A-Z\s]+" title="Solo se permiten letras mayúsculas y espacios">

            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" required
            pattern="[A-Z\s]+" title="Solo se permiten letras mayúsculas y espacios">

            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" required
            pattern="\d{10}" maxlength="10" title="Debe ingresar exactamente 10 dígitos">

            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" required>

            <label for="direccion">Dirección:</label>
<textarea id="direccion" name="direccion" rows="3" oninput="this.value = this.value.toUpperCase()" required></textarea>


            <button type="submit" >Registrar Cliente</button>
            <li>
                <a href="clien_list.php">
                   
                    <h3>ver registro</h3>
                </a>
            </li>
        </form>
    </div>

    <script>
        document.getElementById('registroForm').addEventListener('submit', function(event) {
            var cedula = document.getElementById('cedula').value.trim();

            if (!validarCedula(cedula)) {
                alert('Cédula inválida. Por favor, verifique y vuelva a intentarlo.');
                event.preventDefault(); // Evita el envío del formulario
            }
        });

        function validarCedula(cedula) {
            if (cedula.length !== 10 || isNaN(cedula)) {
                return false;
            }

            // Algoritmo de validación de cédula (para Ecuador)
            var total = 0;
            var longCheck = cedula.length - 1;

            for (var i = 0; i < longCheck; i++) {
                var num = parseInt(cedula.charAt(i));
                if (i % 2 === 0) { // Posición par
                    num *= 2;
                    if (num > 9) num -= 9;
                }
                total += num;
            }

            total = total % 10 ? 10 - total % 10 : 0;

            return parseInt(cedula.charAt(cedula.length - 1)) === total;
        }
    </script>
</body>
</html>
