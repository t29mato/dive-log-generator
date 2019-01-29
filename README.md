# time tracking

No|Date|Time (h)|Action|Place
|:-|:-|:-|:-|:-|:-|
13|2019-01-29|2.0|https化とドメイン設定|通勤電車と帰宅後|
12|2019-01-28|2.5|nginx.confとドメイン設定ごにょごにょ|通勤電車と寝る前|
11|2019-01-28|0.5|php ファイルのアップロード上限変更|通勤電車|
10|2019-01-27|10.0|AWS LightSail本番構築, ドメイン取得|ドドール久我山w/たくまさん, 自宅|
09|2019-01-26|8.0|画像のリサイズ可能に。heroku構築も本番AWSの方が安くて高性能でいっかと判断して方向転換|自宅, ドトール久我山, 自宅|
09|2019-01-22|3.0|テンプレート追加|自宅|
08|2019-01-21|2.0|Modelリファクタ|自宅|
07|2019-01-20|6.0|Modelリファクタ|自宅|
06|2019-01-19|1.5|色を選択できるように|もくもく会@高田馬場|
05|2019-01-14|4.0|heroku構築|自宅|
04|2019-01-13|3.0|heroku構築|自宅|
03|2019-01-12|8.0|heroku構築|自宅|
02|2019-01-04|10.0|初期開発|ヒロくんち|
01|2019-01-03|10.0|初期開発|ヒロくんち|

# LightSail (Amazon Linux)
sudo yum update
sudo yum install php72 php72-mbstring php72-pdo php72-pecl-imagick php72-intl php72-fpm git nginx

sudo curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
sudo chown root:root /usr/local/bin/composer
ll /usr/local/bin/composer

ssh-keygen -t rsa
chmod 700 ~/.ssh

cd /var/www/
git clone https://github.com/t29mato/dive-log-generator.git
sudo chown -R ec2-user:ec2-user /var/www/dive-log-generator
cd /var/www/dive-log-generator

composer install
cp .env.example .env
php artisan key:generate

sudo service nginx start

## eginx is mystery.
sudo vi /etc/nginx/nginx.conf
--- index   index.html index.htm;
+++ index   index.php index.html index.htm;

--- root         /usr/share/nginx/html;
+++ root         /var/www/dive-log-generator/public;
+++ client_max_body_size 20M;

--- location / {
--- }

+++ location / {
+++     try_files $uri /index.php?$query_string;
+++ }

        #error_page 404 /404.html;
        #    location = /40x.html {
        #}

        # redirect server error pages to the static page /50x.html
        #
        #error_page 500 502 503 504 /50x.html;
        #    location = /50x.html {
        #}


remove commetout
        location ~ \.php$ {
            root           html;
            fastcgi_pass   127.0.0.1:9000;
            fastcgi_index  index.php;
            fastcgi_param  SCRIPT_FILENAME  /scripts$fastcgi_script_name;
            include        fastcgi_params;
        }

            fastcgi_pass   unix:/var/run/php-fpm/php-fpm.sock;


sudo vi /etc/php-fpm.d/www.conf

sudo vi /etc/php-fpm-7.2.d/www.conf
    ; listen /var/run/php-fpm/www.sock;
    ; listen = /var/run/php7.2-fpm.sock

## php.ini
post_max_size change over 20M
upload_max_filesize change over 20M

## SSL
sudo ./certbot-auto certonly --webroot -w /var/www/dive-log-generator/public -d log.umineco.me --email tomoya.matou@gmail.com --debug


# For more information on configuration, see:
#   * Official English Documentation: http://nginx.org/en/docs/
#   * Official Russian Documentation: http://nginx.org/ru/docs/

user nginx;
worker_processes auto;
error_log /var/log/nginx/error.log;
pid /var/run/nginx.pid;

# Load dynamic modules. See /usr/share/doc/nginx/README.dynamic.
include /usr/share/nginx/modules/*.conf;

events {
    worker_connections 1024;
}

## /etc/nginx/nginx.conf
http {
    log_format  main  '$remote_addr - $remote_user [$time_local] "$request" '
                      '$status $body_bytes_sent "$http_referer" '
                      '"$http_user_agent" "$http_x_forwarded_for"';

    access_log  /var/log/nginx/access.log  main;

    sendfile            on;
    tcp_nopush          on;
    tcp_nodelay         on;
    keepalive_timeout   65;
    types_hash_max_size 2048;

    include             /etc/nginx/mime.types;
    default_type        application/octet-stream;

    # Load modular configuration files from the /etc/nginx/conf.d directory.
    # See http://nginx.org/en/docs/ngx_core_module.html#include
    # for more information.
    include /etc/nginx/conf.d/*.conf;

    index   index.php index.html index.htm;

    server {
        listen       80 default_server;
        listen       [::]:80 default_server;
        server_name  localhost;
	return	     301 https://$host$request_uri;
        root         /var/www/dive-log-generator/public;
	client_max_body_size 20M;

        # Load configuration files for the default server block.
        include /etc/nginx/default.d/*.conf;

        location / {
	    try_files $uri /index.php?$query_string;
        }

        # proxy the PHP scripts to Apache listening on 127.0.0.1:80
        #
        #location ~ \.php$ {
        #    proxy_pass   http://127.0.0.1;
        #}

        # pass the PHP scripts to FastCGI server listening on 127.0.0.1:9000
        #
        location ~ \.php$ {
        #   root           html;
            fastcgi_pass   unix:/var/run/php-fpm/php-fpm.sock;
            fastcgi_index  index.php;
            fastcgi_param  SCRIPT_FILENAME  /scripts$fastcgi_script_name;
           include        fastcgi_params;
        }

        # deny access to .htaccess files, if Apache's document root
        # concurs with nginx's one
        #
        #location ~ /\.ht {
        #    deny  all;
        #}
    }

    # Settings for a TLS enabled server.
    server {
        listen       443 ssl http2 default_server;
        listen       [::]:443 ssl http2 default_server;
        server_name  localhost;
        root         /var/www/dive-log-generator/public;
        client_max_body_size 20M;

        ssl_certificate /etc/letsencrypt/live/log.umineco.me/fullchain.pem;
        ssl_certificate_key /etc/letsencrypt/live/log.umineco.me/privkey.pem;
        # It is *strongly* recommended to generate unique DH parameters
        # Generate them with: openssl dhparam -out /etc/pki/nginx/dhparams.pem 2048
        #ssl_dhparam "/etc/pki/nginx/dhparams.pem";
        ssl_session_cache shared:SSL:1m;
        ssl_session_timeout  10m;
        ssl_protocols TLSv1 TLSv1.1 TLSv1.2;
        ssl_ciphers HIGH:SEED:!aNULL:!eNULL:!EXPORT:!DES:!RC4:!MD5:!PSK:!RSAPSK:!aDH:!aECDH:!EDH-DSS-DES-CBC3-SHA:!KRB5-DES-CBC3-SHA:!SRP;
        ssl_prefer_server_ciphers on;

        # Load configuration files for the default server block.
        include /etc/nginx/default.d/*.conf;

        location / {
            try_files $uri /index.php?$query_string;
        }

        location ~ \.php$ {
        #   root           html;
            fastcgi_pass   unix:/var/run/php-fpm/php-fpm.sock;
            fastcgi_index  index.php;
            fastcgi_param  SCRIPT_FILENAME  /scripts$fastcgi_script_name;
           include        fastcgi_params;
        }

        error_page 404 /404.html;
            location = /40x.html {
        }

        error_page 500 502 503 504 /50x.html;
            location = /50x.html {
        }
    }

}

vi cron.conf
    0 4 1 * * /usr/local/certbot/certbot-auto renew && sudo service nginx restart
