FROM wukezhan/kos:latest
MAINTAINER WU KEZHAN <wukezhan@gmail.com>
ENV MARIADB_DB NONE
ENV MARIADB_USER mariadb
RUN apt-get update;\
	apt-get install -y mariadb-server;\
	apt-get clean
RUN sed -i -e "s/^bind-address/#bind-address/" /etc/mysql/my.cnf
RUN sed -i -e "s/^datadir.*=.*/datadir = \/data/" /etc/mysql/my.cnf
RUN sed -i -e "s/^innodb_buffer_pool_size.*=.*/innodb_buffer_pool_size = 64M/" /etc/mysql/my.cnf
ADD init /config/init/03mariadb
ADD supervisord.conf /etc/supervisor/conf.d/mariadb.conf
EXPOSE 3306
VOLUME ["/data"]