#!/bin/bash

source config/environment.sh

echo "Poistetaan tietokantataulut..."

ssh $USERNAME@$SERVER "
cd $ROOT_FOLDER/$PROJECT_FOLDER/sql
psql < drop_tables.sql
exit"

echo "Valmis!"
