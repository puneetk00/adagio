rm -rf var/view_preprocessed generated
chmod -R 777 generated var/ pub/static
php bin/magento s:upgrade
php bin/magento s:d:c
php bin/magento s:s:d -f
chmod -R 777 generated var/ pub/static
