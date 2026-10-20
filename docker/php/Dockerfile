FROM php:8.3-apache

# Outils pour Composer + extension PostgreSQL pour PDO
RUN apt-get update \
    && apt-get install -y --no-install-recommends unzip git libpq-dev \
    && docker-php-ext-install pdo_pgsql \
    && rm -rf /var/lib/apt/lists/*

# Réécriture d'URL pour Slim (voir back/public/.htaccess)
RUN a2enmod rewrite

# Composer disponible dans le conteneur
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Le code est monté dans /var/www/html ; Apache sert back/public
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf \
    && printf '<Directory ${APACHE_DOCUMENT_ROOT}>\n    AllowOverride All\n</Directory>\n' > /etc/apache2/conf-available/nrv.conf \
    && a2enconf nrv

WORKDIR /var/www/html
