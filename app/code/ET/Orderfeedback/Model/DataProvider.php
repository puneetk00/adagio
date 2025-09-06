<?php

namespace ET\Orderfeedback\Model;

use ET\Orderfeedback\Model\ResourceModel\Feedback\CollectionFactory;

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
    $name, $primaryFieldName, $requestFieldName, CollectionFactory $feedbackCollectionFactory, \Magento\Store\Model\StoreManagerInterface $storeManager, array $meta = [], array $data = []
    ) {
        $this->collection = $feedbackCollectionFactory->create();
        $this->storeManager = $storeManager;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData() {

        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $mediaUrl = $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);

        $items = $this->collection->getItems();

        foreach ($items as $feedback) {
            $this->loadedData[$feedback->getId()] = $feedback->getData();
        }

        return $this->loadedData;
    }

}
