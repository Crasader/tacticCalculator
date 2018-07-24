#!/bin/bash

if [[ ! $1 ]]
then
    docker-compose exec --user $(ls -lnd . | awk '{print $3}') web bash
else
    docker-compose exec --user $(ls -lnd . | awk '{print $3}') web $@
fi
