# Docker Files

## PHP

```
docker run --name=php-fpm -it -e WWW_USER='root' -v /your/www/data/path:/data wukezhan/php
```

## Nginx

```
docker run --name=nginx -it -p 80:80 -e WWW_USER='root' --link=php-fpm:php-fpm --volumes-from=php-fpm wukezhan/nginx
```

## MariaDB

```
docker run --name=mariadb -it -e MARIADB_USER=core -e MARIADB_PASS=666666 wukezhan/mariadb
```