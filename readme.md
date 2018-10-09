# Tactical Calculator v0.2

### How to install

* docker-compose up -d --build <--- docker container building and run (mysql, apache+config, npm) containers.
* ./helpers/rebuild-site.sh <--- remove logs, rebuild data, run artisan migrations and seeds.

If everything well run, the site will be available on localhost and 8080 port:
*http://localhost:8080*, 

### The structure of project
The project is builds up by Docker. This project has 3 container: mysql, web and npm.

- BackEnd - Laravel 5.6,
- FrontEnd - blade template and VueJS 2.5.7
- Style formatting - SCSS