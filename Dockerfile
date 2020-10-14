FROM alpine:edge

RUN apk add --update \
--repository http://dl-cdn.alpinelinux.org/alpine/edge/main \
--repository http://dl-cdn.alpinelinux.org/alpine/edge/community \
php7-cli php7-common php7-fpm php7-mysqli php7-mcrypt php7-mbstring php7-pgsql php7-pdo php7-pdo_pgsql



RUN apk update \
    && apk add nginx \
    && adduser -D -u 1000 -g 'www' www \
    && mkdir /www \
    && chown -R www:www /var/lib/nginx \
    && chown -R www:www /www \
    && rm -rf /etc/nginx/nginx.conf

ENV PHP_FPM_USER="www"
ENV PHP_FPM_GROUP="www"
ENV PHP_FPM_LISTEN_MODE="0660"
ENV PHP_MEMORY_LIMIT="512M"
ENV PHP_MAX_UPLOAD="50M"
ENV PHP_MAX_FILE_UPLOAD="200"
ENV PHP_MAX_POST="100M"
ENV PHP_DISPLAY_ERRORS="On"
ENV PHP_DISPLAY_STARTUP_ERRORS="On"
ENV PHP_ERROR_REPORTING="E_COMPILE_ERROR\|E_RECOVERABLE_ERROR\|E_ERROR\|E_CORE_ERROR"
ENV PHP_CGI_FIX_PATHINFO=0
ENV TIMEZONE="Europe/Paris"

RUN apk add curl \
    ssmtp \
    tzdata

RUN rm -rf /etc/localtime \
    && ln -s /usr/share/zoneinfo/${TIMEZONE} /etc/localtime \
    && echo "${TIMEZONE}" > /etc/timezone \
    && sed -i "s|;*date.timezone =.*|date.timezone = ${TIMEZONE}|i" /etc/php7/php.ini \
    && sed -i "s|;extension=pdo_pgsql|extension=pdo_pgsql|i" /etc/php7/php.ini \
    && sed -i "s|;extension=pgsql|extension=pgsql|i" /etc/php7/php.ini \
#    && echo "extension=pdo_pgsql.so" > /etc/php7/conf.d/01_pdo_pgsql.ini \
    && echo 'sendmail_path = "/usr/sbin/ssmtp -t "' > /etc/php7/conf.d/mail.ini \
#    && rm -rf /etc/php7/conf.d/00_pgsql.ini /etc/php7/conf.d/01_pdo_pgsql.ini \
    && sed -i 's/mailhub=mail/mailhub=mail.domain.com\:81/g' /etc/ssmtp/ssmtp.conf
#    && chmod 777 /var/log/php7 \
#    && chmod 777 /var/log/nginx
#    && sed -i 's|user = nobody|user = root|i' /etc/php7/php-fpm.d/www.conf \
#    && sed -i 's|group = nobody|group = root|i' /etc/php7/php-fpm.d/www.conf
#    && chown -R nginx: /var/log/php7 \
#    && chown -R www:www /var/log/nginx

COPY nginx.conf /etc/nginx/nginx.conf
COPY html /www
COPY jf.sh /tmp/jf.sh
RUN chmod 755 /tmp/jf.sh
RUN /tmp/jf.sh
COPY start_nginx.sh /start_nginx.sh
COPY start_php-fpm7.sh /start_php-fpm7.sh
COPY start_postgres.sh /start_postgres.sh
COPY wrapper.sh /wrapper.sh

RUN chmod +x /start_nginx.sh /start_php-fpm7.sh /start_postgres.sh /wrapper.sh


# Postgres
RUN apk add postgresql \
  && (addgroup -S postgres && adduser -S postgres -G postgres || true) \
  && mkdir -p /var/lib/postgresql/data \
  && mkdir -p /run/postgresql/ \
  && chown -R postgres:postgres /run/postgresql/ \
  && chmod -R 777 /var/lib/postgresql/data \
  && chown -R postgres:postgres /var/lib/postgresql/data \
  && su - postgres -c "initdb /var/lib/postgresql/data" \
  && echo "host all  all    0.0.0.0/0  md5" >> /var/lib/postgresql/data/pg_hba.conf \
  && echo "listen_addresses = '*'" >> /var/lib/postgresql/data/postgresql.conf

COPY pgdb/jverne.csv /var/lib/pgsql/jverne.csv
RUN su - postgres -c "pg_ctl start -D /var/lib/postgresql/data -l /var/lib/postgresql/log.log && psql --command \"ALTER USER postgres WITH ENCRYPTED PASSWORD 'bonjour';\" && psql --command \"CREATE DATABASE jvernedb;\" && psql jvernedb --command \"CREATE TABLE book(jvid SERIAL PRIMARY KEY,ftitle VARCHAR(200),etitle VARCHAR(200),author VARCHAR(100),year DECIMAL(4));\" && psql jvernedb --command \"COPY book(ftitle,etitle,author,year) FROM '/var/lib/pgsql/jverne.csv' DELIMITER ';' CSV HEADER\";"

CMD ["/wrapper.sh"]
