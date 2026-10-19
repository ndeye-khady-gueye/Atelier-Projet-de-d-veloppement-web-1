FROM php:8.2-apache

# Installation des outils système nécessaires pour Composer (unzip, git)
RUN apt-get update && apt-get install -y unzip git && rm -rf /var/lib/apt/lists/*

# Activation du module mod_rewrite d'Apache pour Slim
RUN a2enmod rewrite

# Installation de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copie du code source dans le conteneur
WORKDIR /var/www/html
COPY . .

# Installation des dépendances PHP sans dev
RUN composer install --no-dev --optimize-autoloader

# On pointe le DocumentRoot d'Apache sur le dossier public (standard Slim)
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/conf-available/*.conf