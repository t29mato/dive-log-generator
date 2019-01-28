# time tracking

No|Date|Time (h)|Action|Place
|:-|:-|:-|:-|:-|:-|
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
sudo yum install php72 php72-mbstring php72-pdo php72-pecl-imagick php72-intl php72-fpm git

sudo curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
sudo chown root:root /usr/local/bin/composer
ll /usr/local/bin/composer

ssh-keygen -t rsa
chmod 700 ~/.ssh

sudo chown -R ec2-user:ec2-user /var/www/dive-log-generator
cp .env.example .env
php composer
php artisan key:generate

sudo service nginx start
sudo vi /etc/nginx/nginx.conf
sudo vim /etc/php-fpm.d/www.conf

## php.ini
post_max_size change over 20M
upload_max_filesize change over 20M

## nginx
server {
    client_max_body_size 20M;
}
