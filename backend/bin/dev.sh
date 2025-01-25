#/bin/bash

### Script pour lancer le serveur de développement

## Node.js
# On utilise NodeJS uniquement pour "bundler" les assets.

# Compilation des assets
npm install && npm run build

# Lancement du serveur de développement
composer install

php artisan cache:clear

composer run dev
