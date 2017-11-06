#!/bin/sh
#inscription.sqlite3
echo "CREATE TABLE contacts (nom,email,tel,age,sexe,municipalite,inscri,date);" | sqlite3 inscription.sqlite3
