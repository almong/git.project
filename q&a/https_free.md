Создаем бесплатный А+ сертификат

https://certbot.eff.org/lets-encrypt/debianstretch-nginx
Устанавливаем openssl.
Переходим в директорию с сертификатами и запускаем: ```openssl dhparam -out dhparam.pem 4096```
```
server {
	listen 80;
	server_name itt.su www.itt.su;
	return 301 https://$server_name$request_uri;
}

server {
	listen 443;
        server_name itt.su www.itt.su;
        add_header Strict-Transport-Security "max-age=63072000; includeSubdomains; preload";
        add_header X-Frame-Options "DENY";
        root /home/alex/www/itt.su;

        ssl on;
        ssl_certificate /etc/letsencrypt/live/itt.su/fullchain.pem;
        ssl_certificate_key /etc/letsencrypt/live/itt.su/privkey.pem;
        ssl_session_cache builtin:1000 shared:SSL:10m;
        ssl_session_timeout 5m;

        ssl_prefer_server_ciphers on;
        ssl_protocols TLSv1 TLSv1.1 TLSv1.2;
        ssl_ciphers EECDH+AESGCM:EDH+AESGCM:AES256+EECDH:AES256+EDH;
        ssl_dhparam /etc/letsencrypt/live/itt.su/dhparam.pem;


        index index.php;

        location ~* \.(jpg|jpeg|gif|css|png|js|ico|html)$ {
                access_log off;
                expires max;
                log_not_found off;
        }


 #      location / {
 #               #add_header Access-Control-Allow-Origin *;
 #               try_files $uri $uri/ /index.php?$query_string;
 #       }

        location ~* \.php$ {
        try_files $uri = 404;
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass unix:/var/run/php/php7.2-fpm.sock; # подключаем сокет php-fpm
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.ht {
                deny all;
        }
}
```
