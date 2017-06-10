#!/bin/bash

# korvaa tämä omalla käyttäjätunnuksellasi
USERNAME="mcparni"
# korvaa tämä palvelimesi osoitteella
SERVER="users2017.cs.helsinki.fi"
# korvaa tämä polulla missä HTML dokumentit sijaitsevat palvelimellasi
# esim public_html, www, srv/www,... 
ROOT_FOLDER="htdocs"
# korvaa tämä haluamallasi kansion nimellä
PROJECT_FOLDER="testbuild"

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
cd $ROOT/$PROJECT_FOLDER
wget https://getcomposer.org/download/1.2.4/composer.phar
php composer.phar install
cat sql/drop_tables.sql sql/create_tables.sql | psql -1 -f -
psql < sql/add_test_data.sql
exit"

echo "Valmis! Sovelluksesi on nyt valmiina osoitteessa $SERVER -palvelimella"
