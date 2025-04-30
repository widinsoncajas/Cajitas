<<<<<<< HEAD
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Vehículo</title>
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
        <h1>Registro de Vehículo</h1>
        <form action="ingreso_raptor.php" method="POST">
            <label for="marca">Marca:</label>
            <input type="text" id="marca" name="marca" required>

            <label for="modelo">Modelo:</label>
            <input type="text" id="modelo" name="modelo" required>

            <label for="anio">Año:</label>
            <input type="tex" id="anio" name="anio"  required>

            <label for="matricula">Matrícula:</label>
            <input type="text" id="matricula" name="matricula" required>

            <label for="estado">Estado:</label>
            <select id="estado" name="estado" required>
                <option value="disponible">disponible</option>
                <option value="reservado">reservado</option>
                <option value="mantenimiento">mantenimiento</option>
                <option value="ocupado">ocupado</option>
            </select>

            <label for="precio_dia">Precio por Día:</label>
            <input type="number" id="precio_dia" name="precio_dia" step="0.01" required>

            <label for="socio">id Socio:</label>
            <input type="text" id="socio" name="socio" required>


            <button type="submit">Registrar Vehículo</button>
        </form>
    </div>
</body>
</html>
=======
<<<<<<< HEAD
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Vehículo</title>
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
        <h1>Registro de Vehículo</h1>
        <form action="ingreso_raptor.php" method="POST">
            <label for="marca">Marca:</label>
            <input type="text" id="marca" name="marca" required>

            <label for="modelo">Modelo:</label>
            <input type="text" id="modelo" name="modelo" required>

            <label for="anio">Año:</label>
            <input type="tex" id="anio" name="anio"  required>

            <label for="matricula">Matrícula:</label>
            <input type="text" id="matricula" name="matricula" required>

            <label for="estado">Estado:</label>
            <select id="estado" name="estado" required>
                <option value="disponible">disponible</option>
                <option value="reservado">reservado</option>
                <option value="mantenimiento">mantenimiento</option>
                <option value="ocupado">ocupado</option>
            </select>

            <label for="precio_dia">Precio por Día:</label>
            <input type="number" id="precio_dia" name="precio_dia" step="0.01" required>

            <label for="socio">id Socio:</label>
            <input type="text" id="socio" name="socio" required>


            <button type="submit">Registrar Vehículo</button>
        </form>
    </div>
</body>
</html>
=======
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Vehículo</title>
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
        <h1>Registro de Vehículo</h1>
        <form action="ingreso_raptor.php" method="POST">
            <label for="marca">Marca:</label>
            <input type="text" id="marca" name="marca" required>

            <label for="modelo">Modelo:</label>
            <input type="text" id="modelo" name="modelo" required>

            <label for="anio">Año:</label>
            <input type="tex" id="anio" name="anio"  required>

            <label for="matricula">Matrícula:</label>
            <input type="text" id="matricula" name="matricula" required>

            <label for="estado">Estado:</label>
            <select id="estado" name="estado" required>
                <option value="disponible">disponible</option>
                <option value="reservado">reservado</option>
                <option value="mantenimiento">mantenimiento</option>
                <option value="ocupado">ocupado</option>
            </select>

            <label for="precio_dia">Precio por Día:</label>
            <input type="number" id="precio_dia" name="precio_dia" step="0.01" required>

            <label for="socio">id Socio:</label>
            <input type="text" id="socio" name="socio" required>


            <button type="submit">Registrar Vehículo</button>
        </form>
    </div>
</body>
</html>
>>>>>>> 3b36bcf60ef3352292526c56cd1c2a3d013545b5
>>>>>>> 385b4c70925897719a0be7311cee9ece92ce7643
