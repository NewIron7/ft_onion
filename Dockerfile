FROM debian:12-slim

RUN apt-get update && apt-get install -y \
    tor nginx openssh-server php8.2-fpm

COPY conf/nginx.conf /etc/nginx/nginx.conf

COPY conf/torrc /etc/tor/torrc

COPY conf/sshd_config /etc/ssh/sshd_config

COPY site/* /var/www/html/

COPY setup.sh .

RUN useradd -m -s /bin/bash ft_onion \
    && mkdir /home/ft_onion/.ssh \
    && chown -R ft_onion:ft_onion /home/ft_onion/.ssh 

COPY --chown=ft_onion:ft_onion ssh/authorized_keys /home/ft_onion/.ssh/authorized_keys

CMD [ "sh", "setup.sh" ]