#!/bin/bash

rm storage/logs/laravel.log || echo ""
rm -rf  storage/app/public/* || echo ""
rm -rf  storage/app/temporary/* || echo ""
./helpers/npm install
./helpers/npm run dev
./helpers/npm run apidoc
cp database/seeds/data/articles_example.csv database/seeds/olddata/articles.csv
cp database/seeds/data/users_example.csv database/seeds/olddata/users.csv
cp database/seeds/data/percrolpercre_example.csv database/seeds/olddata/percrolpercre.csv
cp database/seeds/data/percrolpercre_milestones_example.csv database/seeds/olddata/percrolpercre_milestones.csv
cp database/seeds/data/elore_regiok_example.csv database/seeds/olddata/elore_regiok.csv
cp database/seeds/data/elore_regiok_szel_example.csv database/seeds/olddata/elore_regiok_szel.csv
cp database/seeds/data/elore_regiok_viz_example.csv database/seeds/olddata/elore_regiok_viz.csv
cp database/seeds/data/elore_example.csv database/seeds/olddata/elore.csv
./helpers/artisan migrate:fresh
./helpers/artisan db:seed
echo "Netatmo update ..."
./helpers/artisan netatmo:update
echo "Synop update ..."
./helpers/artisan synop:update
echo "Astronomy update ..."
./helpers/artisan astronomy:sun:update
./helpers/artisan astronomy:moon:update
echo "Nearest place update ..."
./helpers/artisan nearestplace:update
echo "Map sat update ..."
./helpers/artisan map:sat-hu:update
./helpers/artisan map:sat-eu:update
echo "Map rainfall intensity update ..."
./helpers/artisan map:rainfall-intensity:update
echo "Map air pollution update ..."
./helpers/artisan map:air-pollution:update
echo "Map pollen update ..."
./helpers/artisan map:pollen:update
echo "Map hazard update ..."
./helpers/artisan map:hazard:update
echo "Map water temperature update ..."
./helpers/artisan watertemperature:update
echo "Map render ..."
./helpers/artisan map:render
echo "Generating media ..."
./helpers/artisan medialibrary:regenerate
