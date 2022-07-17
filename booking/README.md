php version must be 7.2 and more

1)Download Composer and Visual Studio Code and Wamp
2)Download Zip File from Github and extract It or git clone ssh link
3)Open Project In VSC and Open integrated terminal
4)Run "composer update" "npm init" "npm install"
5)Rename .env.example to .env

6)Run "php artisan key:generate"
7)Set Database name as you like
8)Set Mail(my or yours)
9)Run Wamp and open link "http://localhost/phpmyadmin/" and create database
10)Run "php artisan migrate"
10)Run "php artisan db:seed"
11)Run "php artisan serve"

set at .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=Database name as you like
DB_USERNAME=root
DB_PASSWORD=

MAIL_DRIVER=smtp
MAIL_MAILER=smtp
MAIL_HOST=smtp.ukr.net
MAIL_PORT=465
MAIL_USERNAME=booking_test@ukr.net
MAIL_PASSWORD=tVe4eFTAk2osPrCl
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME=booking_test@ukr.net
