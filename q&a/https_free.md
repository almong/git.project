https://certbot.eff.org/lets-encrypt/debianstretch-nginx

nginx config:

server {
	listen 80;
	server_name itt.su www.itt.su;
	return 301 https://$server_name$request_uri;
}

server {
  listen 443 ssl spdy;
	server_name itt.su www.itt.su;
	root /home/alex/www/itt.su;
  resolver 127.0.0.1;
  ssl_stapling on;
  ssl on;
  ssl_certificate /etc/letsencrypt/live/itt.su/fullchain.pem;
  ssl_certificate_key /etc/letsencrypt/live/itt.su/privkey.pem;
  ssl_session_timeout 24h;
  ssl_session_cache shared:SSL:2m;
  ssl_protocols TLSv1 TLSv1.1 TLSv1.2;
  ssl_ciphers kEECDH+AES128:kEECDH:kEDH:-3DES:kRSA+AES128:kEDH+3DES:DES-CBC3-SHA:!RC4:!aNULL:!eNULL:!MD5:!EXPORT:!LOW:!SEED:!CAMELLIA:!IDEA:!PSK:!SRP:!SSLv2;
  ssl_prefer_server_ciphers on;
  add_header Strict-Transport-Security "max-age=31536000;";
  add_header Content-Security-Policy-Report-Only "default-src https:; script-src https: 'unsafe-eval' 'unsafe-inline'; style-src https: 'unsafe-inline'; img-src https: data:; font-src https: data:; report-uri /csp-report";
    

  index index.php;

  # serve static files directly
  location ~* \.(jpg|jpeg|gif|css|png|js|ico|html)$ {
    access_log off;
    expires max;
    log_not_found off;
  }
  
  # location / {
  # add_header Access-Control-Allow-Origin *;
  # try_files $uri $uri/ /index.php?$query_string;
  # }

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

