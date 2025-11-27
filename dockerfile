FROM php:8.2-apache

# Extensiones necesarias para MySQL (PDO)
RUN docker-php-ext-install pdo pdo_mysql

# Habilitar mod_rewrite (por si luego quieres URLs bonitas)
RUN a2enmod rewrite

# Configurar DocumentRoot en /var/www/html/public
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf \
    && sed -ri -e 's!Directory /var/www/!Directory /var/www/html/public!g' /etc/apache2/apache2.conf

WORKDIR /var/www/html

# Copiar todo el proyecto
COPY . /var/www/html

# Asegurar carpeta de imágenes subida y permisos
RUN mkdir -p /var/www/html/public/assets/perfumes \
    && chown -R www-data:www-data /var/www/html/public/assets
