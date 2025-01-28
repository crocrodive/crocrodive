#/bin/bash
echo "|| Déploiement ||"

echo "Déploiement des assets"
npm i || exit -1
npm run build || exit -1
echo "fait"

echo "Installation des dépendances PHP en mode prod"
composer install --no-dev || exit -1
echo "fait"

echo "Supression des fichiers sur le serveur"

rm -rf ../../private/* ../../private/.[!.]* ../../private/..?*
rm -rf ../../public/* ../../public/.[!.]* ../../public/..?*

echo "fait"

echo "Copie des fichiers sur le serveur"

cp -rT ./ ../../private
cp -rT public/ ../../public

echo "Déploiement terminé :)"
