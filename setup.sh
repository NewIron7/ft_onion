#!/bin/sh

useradd -m $NEW_USER

# Set a password for the new user (you can change this)
echo "$NEW_USER:$PASSWORD" | chpasswd

# start ssh server
service ssh start

# Start tor
service tor restart

service nginx stop

# print the onion address with emojis to make it easier to read
echo -e "\n\nYour onion address is:\n
🔗 $(cat /var/lib/tor/hidden_service/hostname)
"

exec nginx -g "daemon off;"
