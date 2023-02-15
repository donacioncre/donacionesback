FROM php:7.4-fpm
WORKDIR /var/www
# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    zlib1g-dev \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    zip \
    unzip \
    cron \
    && docker-php-ext-configure gd --with-freetype --with-jpeg
#node y npm
RUN apt-get install -y curl \
    && curl -sL https://deb.nodesource.com/setup_14.x | bash - \
    && apt-get install -y nodejs \
    && curl -L https://www.npmjs.com/install.sh | sh
# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*
# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd
RUN docker-php-ext-install pgsql \
    && docker-php-ext-install pdo_pgsql
RUN docker-php-ext-install zip
# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer



# Add user for laravel application
RUN groupadd -g 1000 www 
RUN useradd -u 1000 -ms /bin/bash -g www www
# Copy existing application directory contents
COPY . /var/www

# Copy existing application directory permissions
COPY --chown=www:www . /var/www

RUN chmod -R 777 storage
# --------------------------------------------------------------------
# Add docker custom crontab
ADD crontab /etc/cron.d/crontab

# Give execution rights on the cron job
RUN chmod 0644  /etc/cron.d/crontab

# Specify crontab file for running
RUN crontab /etc/cron.d/crontab

RUN echo "* * * * * root php /var/www/artisan schedule:run >> /var/log/cron.log 2>&1" >> /etc/crontab

RUN touch /var/log/cron.log
#ENTRYPOINT ["cron", "-f"]
# --------------------------------------------------------------------

# Change current user to www
USER www
# Expose port 9000 and start php-fpm server
EXPOSE 9000

#CMD cron  && tail -f /var/log/cron.log
#CMD ["php-fpm","cron","-f"]
#CMD ["php-fpm"]

CMD bash -c "cron && php-fpm"
