const express = require('express');
const path = require('path');
const { exec } = require('child_process'); // Para ejecutar comandos del sistema
const app = express();

// Ruta para ejecutar y servir el archivo PHP
app.get('/', (req, res) => {
  // Comando para ejecutar el archivo PHP
  exec('php ' + path.join(__dirname, 'inicio.php'), (err, stdout, stderr) => {
    if (err) {
      // Si hay un error, muestra el error
      console.error('Error:', err);
      return res.status(500).send('Error ejecutando el archivo PHP');
    }
    if (stderr) {
      // Si hay errores en stderr, muestra esos errores
      console.error('stderr:', stderr);
      return res.status(500).send('Error en la ejecución de PHP');
    }
    // Si no hay errores, responde con la salida del archivo PHP
    res.send(stdout);
  });
});

// Ruta para servir el archivo PHP en GAMA_FAMILIAR
app.get('/GAMA_FAMILIAR/GAMA_FAMI.php', (req, res) => {
  res.sendFile(path.join(__dirname, 'GAMA_FAMILIAR', 'GAMA_FAMI.php'));
});

// Ruta para servir archivos estáticos (imágenes, CSS, JS)
app.use('/GAMA_FAMILIAR', express.static(path.join(__dirname, 'GAMA_FAMILIAR')));

// Puerto donde el servidor escuchará
const port = process.env.PORT || 3000;
app.listen(port, () => {
  console.log(`Servidor corriendo en puerto ${port}`);
});
