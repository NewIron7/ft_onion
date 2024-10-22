#!/bin/sh

# ssh hardening
rm /etc/ssh/ssh_host_*
ssh-keygen -t rsa -b 4096 -f /etc/ssh/ssh_host_rsa_key -N ""
ssh-keygen -t ed25519 -f /etc/ssh/ssh_host_ed25519_key -N ""

awk '$5 >= 3071' /etc/ssh/moduli > /etc/ssh/moduli.safe
mv /etc/ssh/moduli.safe /etc/ssh/moduli

service ssh restart

echo "ft_onion:$FT_ONION_PASSWORD" | chpasswd

# Start tor
service tor restart

service nginx stop

service php8.2-fpm restart

# print the onion address with emojis to make it easier to read
echo -e "\n\nYour onion address is:\n
🔗 $(cat /var/lib/tor/hidden_service/hostname)
"

exec nginx -g "daemon off;"
