
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido - Alquiler de Vehículos</title>
    <style>
        /* Estilos globales */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f4f8;
            color: #333;
            line-height: 1.6;
        }

        header {
            background-color: #007BFF;
            color: white;
            padding: 15px 20px;
            text-align: center;
        }

        header h1 {
            font-size: 24px;
            text-transform: uppercase;
            font-weight: bold;
        }

        .btn-container {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 20px 0;
        }

        .btn {
            text-decoration: none;
            color: white;
            background-color: #007BFF;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        .menu {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .menu .logo {
            font-size: 24px;
            font-weight: bold;
            color: #007BFF;
            text-decoration: none;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        nav a {
            text-decoration: none;
            color: #007BFF;
            font-size: 16px;
            margin: 0 10px;
        }

        nav a:hover {
            text-decoration: underline;
        }

        .navbar {
            display: flex;
            overflow-x: auto; /* Habilita el scroll horizontal en caso de necesitarlo */
            gap: 20px;
            list-style: none;
            padding: 20px 0;
        }

        .navbar li {
            display: inline-block;
            text-align: center;
            min-width: 200px;
            max-width: 300px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .navbar li:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        .navbar li img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 10px 10px 0 0;
        }

        .navbar li h3 {
            padding: 10px;
            font-size: 18px;
            background: #007BFF;
            color: white;
            margin: 0;
            border-radius: 0 0 10px 10px;
        }

        footer {
            background-color: #007BFF;
            color: white;
            text-align: center;
            padding: 10px 0;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Bienvenido al Mejor Sitio de Alquiler de Vehículos</h1>
    </header>

    <div class="btn-container">
        <a href="xxx.php" class="btn">Ver Registros de Reservas</a>
        <a href="reg_clientes.php" class="btn">Registrarse como Cliente</a>
        <a href="clien_list.php" class="btn">Lista de Clientes</a>
        

    </div>

    <div class="menu container">
        <nav>
            <a href="index.html" class="logo">LOGO</a>
            <div>
                <a href="#">Usuario</a>
                <img src="imagenes/EMOTION.jpeg" style="height: 20px; border-radius: 50%;">

                <a href="/acceso.php">Cerrar sesión</a>
                <img src="imagenes/paisaje2.jpg" style="height: 20px; border-radius: 50%;">
            </div>
        </nav>

        <ul class="navbar">
            <li>
                <a href="Kia_blanco.php">
                    <img src="GAMA_FAMILIAR/imagenes_vehiculos/gama alt.jpeg" alt="Gama Alta">
                    <h3>GAMA ALTA</h3>
                </a>
            </li>
            <li>
                <a href="GAMA_MEDIA/GAMA_MEDIAA.php">
                    <img src="GAMA_FAMILIAR/imagenes_vehiculos/FORTUNER.jpg" alt="Gama Media">
                    <h3>GAMA MEDIA</h3>
                </a>
            </li>
            <li>
                <a href="Kia_blanco.php">
                    <img src="GAMA_FAMILIAR/imagenes_vehiculos/CAPTIVA.jpeg" alt="Gama Baja">
                    <h3>GAMA BAJA</h3>
                </a>
            </li>
            <li>
                <a href="GAMA_FAMILIAR/GAMA_FAMI.php">
                    <img src="GAMA_FAMILIAR/imagenes/buceta1.jpeg" alt="Gama Familiar">
                    <h3>GAMA FAMILIAR</h3>
                </a>
            </li>

           
        </ul>
    </div>

    <footer style="background-color: #333; color: #fff; padding: 20px; text-align: center;">
    <p>© 2025 Alquiler de Vehículos - Todos los derechos reservados.</p>
    <p><strong>Dirección:</strong> Av. Quito y Calle Bolívar, Quevedo, Ecuador</p>
    <p><strong>Correo:</strong> <a href="mailto:info@fastcarquevedo.com" style="color: #fff;">info@fastcarquevedo.com</a></p>
    <p><strong>WhatsApp:</strong> <a href="https://wa.me/593999888777" style="color: #fff;" target="_blank">+593 999 888 777</a></p>
    <p>
        <a href="https://www.facebook.com/fastcarquevedo" target="_blank" style="color: #fff; margin: 0 10px;">Facebook</a> |
        <a href="https://www.instagram.com/fastcarquevedo" target="_blank" style="color: #fff; margin: 0 10px;">Instagram</a>
    </p>
</footer>

</body>
</html>
