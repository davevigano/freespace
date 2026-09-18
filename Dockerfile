FROM php:8.2-cli
RUN docker-php-ext-install mysqli

WORKDIR /var/www/html
COPY index.php functions.php helpers.php db.php script.js style.css ./

EXPOSE 80
CMD ["sh", "-c", "php -S 0.0.0.0:${PORT:-80}"]
