#!/usr/bin/env bash

source dev/docker/conf.sh

docker build -t $DOCKER_IMAGE -f dev/docker/Dockerfile .
docker run -dit --name $DOCKER_CONTAINER_NAME -v "$PWD/server:/var/www/html" -p 8080:80 $DOCKER_IMAGE
