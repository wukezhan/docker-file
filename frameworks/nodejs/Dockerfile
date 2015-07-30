FROM wukezhan/ubuntu:latest
MAINTAINER WU KEZHAN <wukezhan@gmail.com>
ENV PATH $PATH:/opt/nodejs/bin
ENV VERSION v0.10.31
RUN mkdir -p /opt/nodejs
RUN wget -O - "http://www.nodejs.org/dist/${VERSION}/node-${VERSION}-linux-x64.tar.gz" | tar --directory=/opt/nodejs --strip-components=1 -x -z
