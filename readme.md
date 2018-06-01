Projeto em Laravel para gerenciar a Loja Web

>>> Instalação  <<<

# instalar pacotes obrígatórios
apt install net-tools
apt install sudo
apt install vim
apt install git
apt install php
apt install php-dom
apt install php-mbstring
apt install php-mysql
apt install curl
apt install zip unzip

# adicionar usuário na lista sudoers
visudo (ou vim /etc/sudoers)
User privilege specification
user ALL=(ALL) ALL
ctrl+x
y

# configurar ip-fixo
vim /etc/network/interfaces

# configurações para o dispositivo de rede 'enp0s3'
auto enp0s3
iface enp0s3 inet static
address 192.168.1.103
netmask 255.255.255.0
gateway 192.168.1.1

# reiniciar conexão de rede
/etc/init.d/networking restart


# configuração do BD MySQL
#criar usuario
CREATE USER 'loja_admin'@'192.168.1.103' IDENTIFIED BY 'loja_admin123@';
#dar permissões para o usuário
GRANT SELECT,INSERT,UPDATE,DELETE,CREATE,DROP,ALTER,INDEX on loja_admin.* TO 'loja_admin'@'192.168.1.103' IDENTIFIED BY 'loja_admin123@';
flush privileges;
#criar BD
create database loja_admin;

cd /var/www/html
git clone https://github.com/hercolysm/loja_admin.git
cd loja_admin

# configuração de banco mysql
vim .env
DB_CONNECTION=mysql
DB_HOST=192.168.1.11
DB_PORT=3306
DB_DATABASE=loja_admin
DB_USERNAME=loja_admin
DB_PASSWORD=loja_admin123@

# instalar composer (global)
(buscar arquivo atualizado no link 'https://getcomposer.org/download/')
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('SHA384', 'composer-setup.php') === '669656bab3166a7aff8a7506b8cb2d1c292f042046c5a994c43155c0be6190fa0355160742ab2e1c88d40d5be660b410') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php --install-dir=/usr/local/bin --filename=composer
php -r "unlink('composer-setup.php');"

composer install (corrigir dependências)

php artisan key:generate

chmod 777 -R storage/framework/sessions/
chmod 777 -R storage/framework/views/
chmod 777 -R storage/logs/

php artisan serve --host=192.168.1.103 --port=80

php artisan migrate:install
php artisan migrate:status
php artisan migrate

php artisan db:seed
