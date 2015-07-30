FROM wukezhan/build:latest
MAINTAINER WU KEZHAN <wukezhan@gmail.com>

RUN mkdir -p /server/php /tmp

ADD helper /tmp/helper

RUN apt-get update; \
	apt-get install -y build-essential autoconf libxml2-dev libcurl4-openssl-dev libc-client2007e-dev libmcrypt-dev libjpeg-dev libpng++-dev libfreetype6-dev;\
	cd tmp; wget http://cn2.php.net/distributions/php-5.5.16.tar.gz; tar zxvf php-5.5.16.tar.gz;\
	/tmp/helper/php-install php-5.5.16  /server/php --disable-all --with-mysqli --with-pcre-regex --enable-ctype --enable-shmop --enable-tokenizer --enable-inline-optimization --enable-session --disable-ipv6 --enable-sockets --enable-fpm --with-freetype-dir --with-jpeg-dir --with-png-dir --enable-soap --enable-mbstring --with-openssl --enable-json --with-iconv --with-curl --enable-bcmath --with-mcrypt --enable-hash --enable-libxml --enable-simplexml --enable-xml --enable-dom --enable-filter --enable-opcache --with-imap --with-imap-ssl --with-kerberos --enable-sigchild --enable-pcntl --enable-pdo --with-pdo-mysql; \
	/tmp/helper/php-ext get-install redis  /server/php; \
	/tmp/helper/php-ext get-install memcache  /server/php; \
	/tmp/helper/php-ext get-install mongo  /server/php; \
	apt-get install -y libmagickwand-dev libmagickcore-dev && /tmp/helper/php-ext get-install imagick  /server/php;\ 
	/tmp/helper/php-ext get-install xhprof  /server/php; \
	apt-get autoclean && apt-get clean && apt-get remove --purge -y autoconf libpcre3-dev libssl-dev libmagickwand-dev libmagickcore-dev; \
	rm -rf /tmp/*

ADD config /config

ADD server /server

RUN ln -s /server/php/supervisor/conf.d/* /etc/supervisor/conf.d/

VOLUME /data

EXPOSE 9000
