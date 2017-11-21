#!/usr/bin/env bash

if [ -d trivia ]; then
  cd trivia
  git pull
  cd ..
else
  git clone https://github.com/antonioribeiro/Open-trivia-database.git trivia
fi

php update.php

mv trivia.json ../database/

rm -rf trivia
