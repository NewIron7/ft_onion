FROM debian:12-slim

RUN apt-get update && apt-get install -y \
    tor nginx openssh-server

COPY conf/nginx.conf /etc/nginx/nginx.conf

COPY conf/torrc /etc/tor/torrc

COPY site/* /var/www/html/

COPY setup.sh .

COPY conf/sshd_config /etc/ssh/sshd_config

CMD [ "sh", "setup.sh" ]