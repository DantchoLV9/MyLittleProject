<p align="center"><img alt="MyLittleProject" src="https://dantcho.files.wordpress.com/2019/01/mlp-logo.png"></p>

<p align="center">
<a href="https://app.codacy.com/app/dantcho.bg/MyLittleProject?utm_source=github.com&utm_medium=referral&utm_content=Dantcho-BG/MyLittleProject&utm_campaign=Badge_Grade_Settings">
<img alt="Codacy Code Quality Badge" src="https://img.shields.io/codacy/grade/8a32c9ebe3164368a16dcdf5a874049c.svg?style=flat">
</a>
<a href="https://discord.gg/7dV6WvM">
<img alt="Discord Server Badge" src="https://img.shields.io/discord/406600571269677057.svg?colorB=7289DA&label=discord&style=flat">
</a>
</p>

## About MyLittleProject

MyLittleProject is a web application created with PHP and Laravel. The aim of MyLittleProject is to provide an easy way for creators to share their projects. The project is still in it's very early stages of developemnt.

## Installation

If you want to install MyLittleProject for production please see the documentation. (Currently there is no documentation available. Enter the discord server or send me an email for instructions!)

### Install Composer Dependencies
```bash
composer install
```
### Install NPM Dependencies
```bash
npm run dev
```
### Make a copy of the .env file
```bash
cp .env.example .env
```
This can also be done manually by making a copy of the .env.example file in the directory where MyLittleProject is cloned and renaming it to .env
### Generate an app encryption key
```bash
php artisan key:generate
```
### Create an empty database
Create an empty database that will be used by MyLittleProject
### Setup a mail server
If you don't have a mail server you can use mailtrap.io for development purposes.
### Change the .env file according to your needs
You need to setup the database connection and mail server connection as they are required for MyLittleProject to work.

To do setup the database connection fill in the ```DB_HOST```, ```DB_DATABASE``` and ```DB_USERNAME``` with the credentials from the database you created. You may also need to change the ```DB_CONNECTION```, ```DB_PORT``` and ```DB_PASSWOR``` depending on the database software you use.

To setup the mail server connection fill in the ```MAIL_DRIVER```, ```MAIL_HOST```, ```MAIL_PORT```, ```MAIL_USERNAME``` and ```MAIL_PASSWORD``` with the credentials from your mail server or your mailtrap.io account. You may also need to change the ```MAIL_ENCRYPTION``` depending on your server.

There are some more things that you may want to change before saving. The ```APP_NAME``` and the ```APP_URL``` are not requred to be changed, but MyLittleProject will still use the values from them.

### Restart your web server after editing the .env file
### Migrate the database
```bash
php artisan migrate
```
### Create a storage link
```bash
php artisan storage:link
```

## Built With

*   [Laravel](https://laravel.com/) - The web framework
*   [Bootstrap](https://getbootstrap.com/) - CSS framework
*   [Intervention Image](http://image.intervention.io/) - Used for image managing
