<?php

namespace ET\Clientreviews\Block;

class Clientreviews extends \Magento\Framework\View\Element\Template implements \Magento\Widget\Block\BlockInterface {

    protected $_storeManager;
    protected $_reviewCollectionFactory;
    protected $_reviewCollection;
    protected $_filterProvider;
    
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context, 
        \Magento\Store\Model\StoreManagerInterface $storeManager, 
        \ET\Clientreviews\Model\ResourceModel\Review\CollectionFactory $reviewCollectionFactory,
        \Magento\Cms\Model\Template\FilterProvider $filterProvider,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_storeManager = $storeManager;
        $this->_reviewCollectionFactory = $reviewCollectionFactory;
        $this->_filterProvider = $filterProvider;
    }

    /**
     * construct function
     */
    protected function _construct() {
        parent::_construct();
        
        $widgetTemplate = 'clientreviews.phtml';
        $demoVersion = $this->getData('demo_version');
        if ($demoVersion == 1) {
            $widgetTemplate = 'clientreviews.phtml';
        } else if ($demoVersion == 2) {
            $widgetTemplate = 'clientreviews2.phtml';
        } else if ($demoVersion == 3) {
            $widgetTemplate = 'clientreviews3.phtml';
        } else if ($demoVersion == 4) {
            $widgetTemplate = 'clientreviews4.phtml';
        } else if ($demoVersion == 5) {
            $widgetTemplate = 'clientreviews5.phtml';
        } else if ($demoVersion == 6) {
            $widgetTemplate = 'clientreviews6.phtml';
        } else if ($demoVersion == 7) {
            $widgetTemplate = 'clientreviews7.phtml';
        } else if ($demoVersion == 8) {
            $widgetTemplate = 'clientreviews8.phtml';
        } else if ($demoVersion == 9) {
            $widgetTemplate = 'clientreviews9.phtml';
        } else if ($demoVersion == 10) {
            $widgetTemplate = 'clientreviews10.phtml';
        } else if ($demoVersion == 11) {
            $widgetTemplate = 'clientreviews11.phtml';
        } else if ($demoVersion == 12) {
            $widgetTemplate = 'clientreviews12.phtml';
        } else if ($demoVersion == 13) {
            $widgetTemplate = 'clientreviews13.phtml';
        } else if ($demoVersion == 14) {
            $widgetTemplate = 'clientreviews14.phtml';
        }
        
        $this->setTemplate('widget/' . $widgetTemplate);
    }
    
    public function getMediaUrl() {
        return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    }
    
    public function getCmsFilterContent($value='') {
        $html = $this->_filterProvider->getPageFilter()->filter($value);
        return $html;
    }
    
    public function getCollection($limit = 2) {
        $collection = $this->_clientReviewCollection->create()
                ->addFieldToFilter('status', '1')
                ->setPageSize($limit)
                ->setOrder('sort_order', 'DESC')
                ->load();
            
        return $collection;
    }
    
    protected function _prepareReviewCollection($limit)
    {
        $this->_reviewCollection = $this->_reviewCollectionFactory->create()
            ->addStoreFilter($this->_storeManager->getStore()->getId())
            ->addFieldtoFilter('status', 1)
            ->setPageSize($limit)
            ->setOrder('sort_order', 'DESC');
    }
    
    public function getReviewCollection($limit = 2)
    {
        if (($this->_reviewCollection)===null) {
            $this->_prepareReviewCollection($limit);
        }

        return $this->_reviewCollection;
    }
}
