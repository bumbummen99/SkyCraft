#!/bin/bash

# Install dependencies
composer install --no-dev
npm install

rm -rf ./dist

# Build
gulp dist

# Bundle
cd dist && zip -r skycraft.zip ./ -x ./node_modules ./node_modules/**\* ./src ./src/**\* ./.browserslistrc ./.editorconfig ./.gitignore ./.travis.yml ./bundle.sh ./codesniffer.ruleset.xml ./composer.json ./composer.lock ./gulpconfig.json ./gulpfile.js ./package-lock.json ./package.json