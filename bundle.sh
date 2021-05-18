#!/bin/bash

# Install dependencies
composer install --no-dev
npm install

rm -rf ./dist

# Build
gulp dist

# Bundle
mv dist/ skycraft/
rm -R ./skycraft/node_modules
rm -R ./skycraft/src
rm ./skycraft/.browserslistrc
rm ./skycraft/.editorconfig
rm ./skycraft/.gitignore
rm ./skycraft/.travis.yml
rm ./skycraft/bundle.sh
rm ./skycraft/codesniffer.ruleset.xml
rm ./skycraft/composer.json
rm ./skycraft/composer.lock
rm ./skycraft/gulpconfig.json
rm ./skycraft/gulpfile.js
rm ./skycraft/package-lock.json
rm ./skycraft/package.json
zip -r skycraft.zip ./skycraft

# Cleanup
rm -R skycraft/