sudo chmod -R 777 generated var/ pub/static
sudo rm -rf var/view_preprocessed
sudo rm -rf generated
chmod -R 777 generated var/ pub/static
sudo php bin/magento s:up
sudo php bin/magento s:d:c
sudo php bin/magento s:s:d -f
sudo php bin/magento c:c
sudo php bin/magento c:f
sudo chmod -R 777 generated var/ pub/static
