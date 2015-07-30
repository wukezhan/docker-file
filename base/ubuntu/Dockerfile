FROM ubuntu:latest
MAINTAINER WU KEZHAN <wukezhan@gmail.com>

RUN apt-get update
RUN apt-get install -y ca-certificates inotify-tools pwgen supervisor unzip wget
RUN apt-get clean
ADD init /config/init/01ubuntu
ADD loop /config/loop
RUN chmod +x /config/loop
RUN mkdir -p /config/data /config/init /data /var/log/supervisor

CMD /config/loop