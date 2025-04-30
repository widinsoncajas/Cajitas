# Usa una imagen base de Node.js
FROM node:14

# Establece el directorio de trabajo en el contenedor
WORKDIR /app

# Copia el archivo package.json y package-lock.json (si existe)
COPY package*.json ./

# Instala las dependencias de Node.js
RUN npm install

# Instala PHP y PHP-FPM
RUN apt-get update && apt-get install -y \
    php \
    php-cli \
    php-fpm \
    && apt-get clean

# Copia el resto de los archivos del proyecto al contenedor
COPY . .

# Expón el puerto en el que la aplicación corre (3000 para Node.js y 80 para PHP)
EXPOSE 3000 80

# Comando para ejecutar ambos servidores (Node.js y PHP) en paralelo
CMD ["sh", "-c", "php -S 0.0.0.0:80 & node index.js"]

