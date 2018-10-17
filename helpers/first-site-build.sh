#!/bin/bash

echo "First Site Build: "

echo "Copy .env.ci file ..."
cp ./.env.ci ./.env

echo "Laravel: generate app key ..."
./helpers/artisan key:generate

echo "The storage folder linking ..."
./helpers/artisan storage:link

echo "NPM install ..."
./helpers/npm install

echo "Migrate fresh and db:seed ..."
./helpers/artisan migrate:fresh
./helpers/artisan db:seed

echo "Building frontend components ..."
./helpers/npm run dev

#echo "Composer Autoload files generate ..."
#./shell.sh composer dump-autoload

echo "Konec."

