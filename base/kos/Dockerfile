FROM ubuntu:latest
MAINTAINER WU KEZHAN <wukezhan@gmail.com>

RUN apt-get update;\
	apt-get install -y ca-certificates inotify-tools pwgen supervisor unzip wget;\
	apt-get clean

ADD init /config/init/01ubuntu
ADD loop /config/loop

RUN chmod +x /config/loop;\
	mkdir -p /config/data /config/init /data /var/log/supervisor

CMD /config/loop