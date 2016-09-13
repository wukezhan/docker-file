FROM wukezhan/build:latest
MAINTAINER WU KEZHAN <wukezhan@gmail.com>

RUN mkdir -p /tmp

ADD config /config
ADD helper /tmp/helper

ENV NGINX_VERSION nginx-1.9.9
ENV LUAJIT_VERSION LuaJIT-2.0.3
ENV NGINX_DEVKIT_VERSION 0.2.19
ENV LUA_NGINX_VERSION 0.9.20rc3

ENV PHP_VERSION php-5.6.16

RUN apt-get update; \
	apt-get install -y libpcre3-dev libssl-dev; \
	cd /tmp; \
	wget http://luajit.org/download/${LUAJIT_VERSION}.tar.gz; \
	tar zxvf ${LUAJIT_VERSION}.tar.gz; cd ${LUAJIT_VERSION}; make && make install; \
	export LUAJIT_LIB=/usr/local/lib/; export LUAJIT_INC=/usr/local/include/luajit-2.0; \
	cd /tmp; \
	wget https://github.com/simpl/ngx_devel_kit/archive/v${NGINX_DEVKIT_VERSION}.tar.gz;tar zxvf v${NGINX_DEVKIT_VERSION}.tar.gz; \
	wget https://github.com/openresty/lua-nginx-module/archive/v${LUA_NGINX_VERSION}.tar.gz; \
	tar zxvf v${LUA_NGINX_VERSION}.tar.gz; \
	wget http://nginx.org/download/${NGINX_VERSION}.tar.gz; \
	tar zxvf ${NGINX_VERSION}.tar.gz; \
	cd ${NGINX_VERSION}; ./configure --prefix=/server/nginx \
		--with-http_ssl_module \
		--with-ld-opt='-Wl,-rpath,/usr/local/lib/' \
		--add-module=/tmp/ngx_devel_kit-${NGINX_DEVKIT_VERSION} \
		--add-module=/tmp/lua-nginx-module-${LUA_NGINX_VERSION}; \
	make -j2 && make install; \
	rm -rf /server/nginx/conf/nginx.conf; \
	apt-get install -y build-essential autoconf bison re2c libxml2-dev libcurl4-openssl-dev libevent-dev; \
	cd /tmp; wget http://cn2.php.net/distributions/${PHP_VERSION}.tar.gz; tar zxvf ${PHP_VERSION}.tar.gz; \
	/tmp/helper/php-install ${PHP_VERSION} /server/php --enable-debug --enable-opcache --enable-fpm --enable-mysqlnd --with-mysqli --with-curl --enable-sigchild --enable-pcntl --enable-mbstring --enable-sockets --enable-bcmath; \
	/tmp/helper/php-ext get-install event; \
	apt-get autoclean && apt-get clean; \
	rm -rf /tmp/*

ADD helper /tmp/helper
ENV AIR_VERSION air-0.5.0-php5-alpha
RUN mkdir -p /tmp/php-cache; cd /tmp/php-cache; wget https://github.com/wukezhan/air/archive/${AIR_VERSION}.zip; unzip ${AIR_VERSION}.zip; \
	mv air-${AIR_VERSION} ${AIR_VERSION}; ls -al; \
	/tmp/helper/php-ext install air /server/php; \
	mv ${AIR_VERSION}/docs/hello-world/* /data/ && cp -rf ${AIR_VERSION}/docs /data/ && mkdir /data/logs

ADD server /server
RUN ln -s /server/*/supervisor/conf.d/* /etc/supervisor/conf.d/
EXPOSE 80
VOLUME /data
VOLUME /var/log
