FROM dunglas/frankenphp:alpine

RUN apk add --no-cache bash zsh git shadow

RUN install-php-extensions \
    pdo_pgsql \
	intl \
	zip \
	opcache \
	apcu \
    @composer

# Symfony cli
RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.alpine.sh' | bash && \
    apk add symfony-cli && \
    sh -c "$(curl -fsSL https://raw.github.com/ohmyzsh/ohmyzsh/master/tools/install.sh)"

ENV SERVER_NAME=:80

WORKDIR /app

COPY . /app

RUN composer install