<?php

namespace ET\Bannerslider\Block;

class Bannerslider extends \Magento\Framework\View\Element\Template implements \Magento\Widget\Block\BlockInterface {

    protected $_storeManager;
    protected $_filterProvider;
    protected $_bannerCollectionFactory;
    protected $_bannerCollection;
    protected $_date;
    
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context, 
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \ET\Bannerslider\Model\ResourceModel\Banner\CollectionFactory $bannerCollectionFactory,
        \Magento\Cms\Model\Template\FilterProvider $filterProvider,
        \Magento\Framework\Stdlib\DateTime\DateTime $date,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_storeManager = $storeManager;
        $this->_bannerCollectionFactory = $bannerCollectionFactory;
        $this->_filterProvider = $filterProvider;
        $this->_date = $date;
    }

    /**
     * construct function
     */
    protected function _construct() {
        parent::_construct();
        $this->setTemplate('widget/bannerslider.phtml');
    }
    
    public function getMediaUrl() {
        return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    }
    
    public function getCmsFilterContent($value='') {
        $html = $this->_filterProvider->getPageFilter()->filter($value);
        return $html;
    }
    
    protected function _prepareBannerCollection()
    {
        $date = $this->_date->date();
        $this->_bannerCollection = $this->_bannerCollectionFactory->create()
            ->addStoreFilter($this->_storeManager->getStore()->getId())
            ->addFieldtoFilter('status', 1)
            ->addFieldtoFilter('end_date', array(array('gteq' => $date)))
            ->addFieldtoFilter('start_date', array(array('lteq' => $date)))
            ->setOrder('sort_order', 'ASC');
    }

    public function getBannerCollection()
    {
        if (($this->_bannerCollection)===null) {
            $this->_prepareBannerCollection();
        }

        return $this->_bannerCollection;
    }

}
