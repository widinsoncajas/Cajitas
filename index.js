const express = require('express');
const path = require('path');
const { exec } = require('child_process'); // Para ejecutar comandos del sistema
const app = express();

// Ruta para ejecutar y servir el archivo PHP en la página principal
app.get('/', (req, res) => {
  // Comando para ejecutar el archivo PHP
  exec('php ' + path.join(__dirname, 'inicio.php'), (err, stdout, stderr) => {
    if (err) {
      console.error('Error:', err);
      return res.status(500).send('Error ejecutando el archivo PHP');
    }
    if (stderr) {
      console.error('stderr:', stderr);
      return res.status(500).send('Error en la ejecución de PHP');
    }
    // Si no hay errores, responde con la salida del archivo PHP
    res.send(stdout);
  });
});

// Ruta para ejecutar y servir el archivo PHP en GAMA_FAMILIAR
app.get('GAMA_FAMILIAR/GAMA_FAMI.php', (req, res) => {
  const phpFilePath = path.join(__dirname, 'GAMA_FAMILIAR', 'GAMA_FAMI.php');
  exec(`php ${phpFilePath}`, (err, stdout, stderr) => {
    if (err) {
      console.error('Error al ejecutar PHP:', err);
      return res.status(500).send('Error ejecutando el archivo coño PHP');
    }
    if (stderr) {
      console.error('stderr:', stderr);
      return res.status(500).send('Error en la ejecución de PHP');
    }
    res.send(stdout);  // Devuelve la salida del archivo PHP
  });
});



// Puerto donde el servidor escuchará
const port = process.env.PORT || 3000;
app.listen(port, () => {
  console.log(`Servidor corriendo en puerto ${port}`);
});
