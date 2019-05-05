#!/usr/bin/env bash

source dev/docker/conf.sh

docker stop $DOCKER_CONTAINER_NAME
docker container rm $DOCKER_CONTAINER_NAME
