# accupuncture
School project on the famous chinese medicine

## Install

### Composer
Install composer
then run in your terminal: "sudo" composer i

### Htaccess
Add in "/etc/apache2/sites-enabled/000-default.conf", after DocumentRoot /var/www/html
<Directory /var/www/html>
    AllowOverride FileInfo
</Directory>

In terminal
sudo a2enmod rewrite


## Structure
accupuncture/
|-- app
    |-- config
    |-- controller
        |-- App.php
        |-- BaseController.php
        |-- SiteController.php
        |-- UserController.php
        |-- ViewController.php
    |-- css
        |-- dist
        |-- styles.css
    |-- model
        |-- Keywords.php
        |-- Model.php
        |-- Pathologie.php
        |-- Symptome.php
        |-- Users.php
    |-- ressources
    |-- static
        |-- pathoSubTypeName.php
        |-- pathoTypeName.php
        |-- pathoTypeSubType.php
    |-- views
    |-- config.php
    |-- index.php
    |-- routes.php
|-- migrations
|-- mockups
|-- ressources
|-- .gitignore
|-- .htaccess
|-- composer.json
|-- composer.lock
|-- README.md