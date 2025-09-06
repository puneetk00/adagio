<?php

namespace ET\Promotionbar\Model;

use ET\Promotionbar\Model\ResourceModel\Promotion\CollectionFactory;

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
    $name, $primaryFieldName, $requestFieldName, CollectionFactory $promotionCollectionFactory, \Magento\Store\Model\StoreManagerInterface $storeManager, array $meta = [], array $data = []
    ) {
        $this->collection = $promotionCollectionFactory->create();
        $this->storeManager = $storeManager;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData() {

        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $mediaUrl = $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);

        $items = $this->collection->getItems();

        foreach ($items as $promotion) {
            $this->loadedData[$promotion->getId()] = $promotion->getData();
        }

        return $this->loadedData;
    }

}
