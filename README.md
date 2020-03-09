# geoipmap
Put php files and directory in your favorite www location default is /var/www/html/geoip
Install geoip database, by : 
# mysql; 
> CREATE DATABASE geoip;
> quit

# mysql geoip <  /var/www/html/geoip/install/geoip.sql

Move geoipmap.sh somewhere
# mv geoipmap.sh /usr/bin
# chmod +x /usr/bin/geoipmap/sh 

Try to retrieve geoip information from /var/secure.log :
# /usr/bin/geoipmap.sh

Tag by flagging category :
# /usr/bin/geoipmap.sh --category=ssh-failed

Retrieve logging from remote host (assuming ssh-keys-pairing) 
# /usr/bin/geoipmap.sh --category=ssh-failed --host=your-remote-host.fqdn.or.ip



