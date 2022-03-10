composer install
cp /docker/html/taling/src_b/current/.env /var/lib/jenkins/workspace/taling/week_5
/usr/bin/php8.1 artisan test

/home/jenkins/.nvm/versions/node/v14.19.0/bin/npm install
/home/jenkins/.nvm/versions/node/v14.19.0/bin/npx mix --production

cd /docker/html/taling/src

rm -rf /docker/html/taling/src_b/current
mv /docker/html/taling/src/current /docker/html/taling/src_b/
mv /var/lib/jenkins/workspace/taling/week_5 /docker/html/taling/src/
mv week_5 current

cd current
chmod 777 -R storage/*

/usr/bin/php8.1 artisan migrate --force
/usr/bin/php8.1 artisan cache:clear
/usr/bin/php8.1 artisan view:clear
/usr/bin/php8.1 artisan config:cache
