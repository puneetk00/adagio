<?php

namespace ET\Bannerslider\Model;

use ET\Bannerslider\Model\ResourceModel\Banner\CollectionFactory;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider {

    /**
     * @var array
     */
    protected $loadedData;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    // @codingStandardsIgnoreStart
    public function __construct(
    $name, $primaryFieldName, $requestFieldName, CollectionFactory $bannerCollectionFactory, \Magento\Store\Model\StoreManagerInterface $storeManager, array $meta = [], array $data = []
    ) {
        $this->collection = $bannerCollectionFactory->create();
        $this->storeManager = $storeManager;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData() {

        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $mediaUrl = $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);

        $items = $this->collection->getItems();

        foreach ($items as $banner) {
            //$this->loadedData[$banner->getId()] = $banner->getData();
            $bannerId = $banner->getId();
            $bannerData = $banner->getData();
            $banner_img = $bannerData['img'];
            $banner_img_url = $mediaUrl . 'bannerslider/image/' . $banner_img;
            unset($bannerData['img']);
            $bannerData['img'][0]['name'] = $banner_img;
            $bannerData['img'][0]['url'] = $banner_img_url;
            $this->loadedData[$bannerId] = $bannerData;
        }

        return $this->loadedData;
    }

}
