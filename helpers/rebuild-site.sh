#!/bin/bash

echo "Remove unused files ..."
rm storage/logs/laravel.log || echo ""
rm -rf  storage/app/public/* || echo ""
rm -rf  storage/app/temporary/* || echo ""
rm -rf  node_modules || echo ""

echo "Rebuild NPM ..."
./helpers/npm install

echo "Migrate fresh and db:seed ..."
./helpers/artisan migrate:fresh
./helpers/artisan db:seed

echo "Building frontend components ..."
./helpers/npm run dev

echo "Rebuild was successfully done."

