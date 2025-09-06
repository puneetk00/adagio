<?php

namespace ET\Clientreviews\Model;

use ET\Clientreviews\Model\ResourceModel\Review\CollectionFactory;

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
    $name, $primaryFieldName, $requestFieldName, CollectionFactory $reviewCollectionFactory, \Magento\Store\Model\StoreManagerInterface $storeManager, array $meta = [], array $data = []
    ) {
        $this->collection = $reviewCollectionFactory->create();
        $this->storeManager = $storeManager;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData() {

        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $mediaUrl = $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);

        $items = $this->collection->getItems();

        foreach ($items as $review) {
            //$this->loadedData[$review->getId()] = $review->getData();
            $reviewId = $review->getId();
            $reviewData = $review->getData();
            $review_img = $reviewData['profile_img'];
            $review_img_url = $mediaUrl . 'clientreviews/image/' . $review_img;
            unset($reviewData['profile_img']);
            $reviewData['profile_img'][0]['name'] = $review_img;
            $reviewData['profile_img'][0]['url'] = $review_img_url;
            $this->loadedData[$reviewId] = $reviewData;
        }

        return $this->loadedData;
    }

}
