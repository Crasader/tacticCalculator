# Tactical Calculator

## How to install

* docker-compos up -d --build <--- docker container building and run (mysql, apache+config, npm) containers.
* ./helpers/rebuild-site.sh <--- remove logs, rebuild data, run migrations and seeds.
* ./helpers/npm run watch <--- run scss and vue builder if you want developing the code.

If everything went successfull, then 
*http://localhost:8080*, 
when the page is available.