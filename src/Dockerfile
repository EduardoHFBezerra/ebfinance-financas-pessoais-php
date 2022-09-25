FROM oberd/php-8.0-apache

# PDO PostgreSQL e MySQL
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql pdo_mysql mysqli
RUN a2enmod rewrite
ENV TZ 'America/Sao_Paulo'
