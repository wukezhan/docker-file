FROM wukezhan/kos:latest
MAINTAINER WU KEZHAN <wukezhan@gmail.com>

ENV DEBIAN_FRONTEND noninteractive
RUN useradd -u 500 core
RUN apt-get update\
	&& apt-get install -y build-essential\
	&& apt-get clean