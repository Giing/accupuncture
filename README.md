# accupuncture
School project on the famous chinese medicine

## Config

### Htaccess
Add in "/etc/apache2/sites-enabled/000-default.conf", after DocumentRoot /var/www/html
<Directory /var/www/html>
    AllowOverride FileInfo
</Directory>

In terminal
sudo a2enmod rewrite


