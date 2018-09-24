#! /bin/bash
sudo nmap -sP -n 192.168.1.0/24 | grep MAC | sed -e 's/.*\: \(\([0-9a-fA-F]\{2\}\:\?\)\{6\}\).*/\1/' > /home/pi/mac.txt
/home/pi/find_subscriptions.sh

