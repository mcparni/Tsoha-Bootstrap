#!/bin/bash

source config/environment.sh

echo "Luodaan projektikansio..."

# Luodaan projektin kansio
ssh $USERNAME@$SERVER "
cd $ROOT_FOLDER
touch favicon.ico
mkdir $PROJECT_FOLDER
cd $PROJECT_FOLDER
touch .htaccess
echo 'RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^ index.php [QSA,L]' > .htaccess
exit"

echo "Valmis!"

echo "Siirretään tiedostot $SERVER -palvelimelle..."

# Siirretään tiedostot palvelimelle
scp -r app config lib vendor sql assets index.php composer.json $USERNAME@$SERVER:$ROOT_FOLDER/$PROJECT_FOLDER

echo "Valmis!"

echo "Asetetaan käyttöoikeudet ja asennetaan Composer..."

# Asetetaan oikeudet ja asennetaan Composer
ssh $USERNAME@$SERVER "
chmod -R a+rX $ROOT_FOLDER
cd $ROOT_FOLDER/$PROJECT_FOLDER
wget https://getcomposer.org/download/1.2.4/composer.phar
php composer.phar install
exit"

echo "Valmis! Sovelluksesi on nyt valmiina osoitteessa $SERVER -palvelimella kansiossa $ROOT_FOLDER/$PROJECT_FOLDER"
