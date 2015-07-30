FROM wukezhan/build:latest
MAINTAINER WU KEZHAN <wukezhan@gmail.com>

RUN apt-get update;\
	apt-get install -y libpcre3-dev libssl-dev;\
	mkdir -p /server/nginx;\
	cd /tmp;\
	wget http://luajit.org/download/LuaJIT-2.0.3.tar.gz;\
	tar zxvf LuaJIT-2.0.3.tar.gz; cd LuaJIT-2.0.3; make && make install;\
	export LUAJIT_LIB=/usr/local/lib/; export LUAJIT_INC=/usr/local/include/luajit-2.0;\
	cd /tmp; \
	wget https://github.com/simpl/ngx_devel_kit/archive/v0.2.19.tar.gz;tar zxvf v0.2.19.tar.gz;\
	wget https://github.com/openresty/lua-nginx-module/archive/v0.9.16rc1.tar.gz;\
	tar zxvf v0.9.16rc1.tar.gz;\
	wget http://nginx.org/download/nginx-1.7.7.tar.gz;\
	tar zxvf nginx-1.7.7.tar.gz;\
	cd nginx-1.7.7; ./configure --prefix=/server/nginx \
		--with-http_ssl_module \
		--with-ld-opt='-Wl,-rpath,/usr/local/lib/' \
		--add-module=/tmp/ngx_devel_kit-0.2.19 \
		--add-module=/tmp/lua-nginx-module-0.9.16rc1;\
	make -j2 && make install;\
	rm -rf /server/nginx/conf/nginx.conf;\
	rm -rf /tmp/*

ADD config /config
ADD server /server
RUN ln -s /server/*/supervisor/conf.d/* /etc/supervisor/conf.d/
EXPOSE 80
VOLUME /server/nginx
