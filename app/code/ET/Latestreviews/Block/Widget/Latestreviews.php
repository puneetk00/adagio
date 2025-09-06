<?php

namespace ET\Latestreviews\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

class Latestreviews extends Template implements BlockInterface {
    
    protected $_storeManager;
    protected $_reviewCollectionFactory;
    protected $_productFactory;
    
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context, 
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Review\Model\ResourceModel\Review\CollectionFactory $reviewCollectionFactory,
        \Magento\Catalog\Model\ProductFactory $productFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_storeManager = $storeManager;
        $this->_reviewCollectionFactory = $reviewCollectionFactory;
        $this->_productFactory = $productFactory;
    }

    /**
     * construct function
     */
    protected function _construct() 
    {
        parent::_construct();
        $this->setTemplate('widget/latestreviews.phtml');
    }
    
    public function getLatestReviews($limit = 5) 
    {
        $storeId = $this->_storeManager->getStore()->getId();

        $collection = $this->_reviewCollectionFactory->create()
                ->addFieldToSelect('*')
                ->addStoreFilter($storeId)
                ->addStatusFilter(\Magento\Review\Model\Review::STATUS_APPROVED)
                ->setDateOrder();
        $collection->getSelect()->limit($limit);
        $collection->addRateVotes();
        
        return $collection;
    }
    
    public function getProductData($productId)
    {
        $productData = $this->_productFactory->create()->load($productId);
        return $productData;
    }
}
