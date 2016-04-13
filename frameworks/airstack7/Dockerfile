FROM wukezhan/build:latest
MAINTAINER WU KEZHAN <wukezhan@gmail.com>

RUN mkdir -p /tmp

ADD config /config
ADD helper /tmp/helper

RUN apt-get update; \
	apt-get install -y libpcre3-dev libssl-dev; \
	cd /tmp; \
	wget http://luajit.org/download/LuaJIT-2.0.3.tar.gz; \
	tar zxvf LuaJIT-2.0.3.tar.gz; cd LuaJIT-2.0.3; make && make install; \
	export LUAJIT_LIB=/usr/local/lib/; export LUAJIT_INC=/usr/local/include/luajit-2.0; \
	cd /tmp; \
	wget https://github.com/simpl/ngx_devel_kit/archive/v0.2.19.tar.gz;tar zxvf v0.2.19.tar.gz; \
	wget https://github.com/openresty/lua-nginx-module/archive/v0.9.20rc3.tar.gz; \
	tar zxvf v0.9.20rc3.tar.gz; \
	wget http://nginx.org/download/nginx-1.9.9.tar.gz; \
	tar zxvf nginx-1.9.9.tar.gz; \
	cd nginx-1.9.9; ./configure --prefix=/server/nginx \
		--with-http_ssl_module \
		--with-ld-opt='-Wl,-rpath,/usr/local/lib/' \
		--add-module=/tmp/ngx_devel_kit-0.2.19 \
		--add-module=/tmp/lua-nginx-module-0.9.20rc3; \
	make -j2 && make install; \
	rm -rf /server/nginx/conf/nginx.conf; \
	apt-get install -y build-essential autoconf bison re2c libxml2-dev libcurl4-openssl-dev libevent-dev; \
	cd /tmp; wget http://cn2.php.net/distributions/php-7.0.1.tar.gz; tar zxvf php-7.0.1.tar.gz; \
	/tmp/helper/php-install php-7.0.1 /server/php --enable-debug --enable-opcache --enable-fpm --enable-mysqlnd --with-mysqli --with-curl --enable-sigchild --enable-pcntl --enable-mbstring --enable-sockets --enable-bcmath; \
	/tmp/helper/php-ext get-install event; \
	apt-get autoclean && apt-get clean; \
	rm -rf /tmp/*

ADD helper /tmp/helper
ENV AIR_VERSION air-0.1.0-php7-alpha
RUN mkdir -p /tmp/php-cache; cd /tmp/php-cache; wget https://github.com/wukezhan/air/archive/${AIR_VERSION}.zip; unzip ${AIR_VERSION}.zip; \
	mv air-${AIR_VERSION} ${AIR_VERSION}; ls -al; \
	/tmp/helper/php-ext install air /server/php; \
	mv ${AIR_VERSION}/docs/hello-world/* /data/ && cp -rf ${AIR_VERSION}/docs /data/ && mkdir /data/logs

ADD server /server
RUN ln -s /server/*/supervisor/conf.d/* /etc/supervisor/conf.d/
EXPOSE 80
VOLUME /data
VOLUME /var/log