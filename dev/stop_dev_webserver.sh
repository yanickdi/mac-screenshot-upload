#!/usr/bin/env bash

source dev/docker/conf.sh

docker stop mac-screenshot-upload-server
docker container rm $DOCKER_CONTAINER_NAME
