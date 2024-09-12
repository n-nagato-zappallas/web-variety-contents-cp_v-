FROM php:8.2.17-apache

# パッケージの更新とPDO MySQL拡張のインストール
RUN apt update \
    && docker-php-ext-install pdo_mysql

# Apacheの設定を追加
RUN echo '<Directory /var/www/html>\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' >> /etc/apache2/apache2.conf
