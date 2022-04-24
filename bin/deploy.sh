#!/usr/bin/env bash

lftp ${SFTP_URL} -e "set cmd:fail-exit yes;
cd www_slzbs2;
mkdir -f bin;
mirror --verbose --continue --delete --use-pget-n=8 --parallel=8 -R bin bin;
mirror --verbose --continue --delete --use-pget-n=8 --parallel=8 -R config config;
mirror --verbose --continue --delete --use-pget-n=8 --parallel=8 -R public public;
mirror --verbose --continue --delete --use-pget-n=8 --parallel=8 -R src src;
mirror --verbose --continue --delete --use-pget-n=8 --parallel=8 -R templates templates;
put composer.json;
put composer.lock;
put symfony.lock;
exit;"
