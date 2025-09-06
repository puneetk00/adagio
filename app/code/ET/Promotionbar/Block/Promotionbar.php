<?php

namespace ET\Promotionbar\Block;

use Magento\Store\Model\ScopeInterface;

class Promotionbar extends \Magento\Framework\View\Element\Template {
    
    protected $_storeManager;
    protected $_filterProvider;
    protected $_promotionBarCollectionFactory;
    protected $_promotionBarCollection;
    protected $_date;
    protected $_logo;
    
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Cms\Model\Template\FilterProvider $filterProvider,
        \ET\Promotionbar\Model\ResourceModel\Promotion\CollectionFactory $promotionBarCollectionFactory,
        \Magento\Framework\Stdlib\DateTime\DateTime $date,
        \Magento\Theme\Block\Html\Header\Logo $logo,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_storeManager = $storeManager;
        $this->_filterProvider = $filterProvider;
        $this->_promotionBarCollectionFactory = $promotionBarCollectionFactory;
        $this->_date = $date;
        $this->_logo = $logo;
    }

    public function getMediaUrl() {
        return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    }
    
    public function getBaseUrl() {
        return $this->_storeManager->getStore()->getBaseUrl();
    }
    
    public function getCmsFilterContent($value='') {
        $html = $this->_filterProvider->getPageFilter()->filter($value);
        return $html;
    }
    
    protected function _preparePromotionBarCollection()
    {
        $date = $this->_date->date();
        $this->_promotionBarCollection = $this->_promotionBarCollectionFactory->create()
            ->addStoreFilter($this->_storeManager->getStore()->getId())
            ->addFieldtoFilter('status', 1)
            ->addFieldtoFilter('end_date', array(array('gteq' => $date)))
            ->addFieldtoFilter('start_date', array(array('lteq' => $date)))
            ->setOrder('sort_order', 'ASC');
    }

    public function getPromotionBarCollection()
    {
        if (($this->_promotionBarCollection)===null) {
            $this->_preparePromotionBarCollection();
        }

        return $this->_promotionBarCollection;
    }
    
    public function isHomePage()
    {
        return $this->_logo->isHomePage();
    }
    
    public function getConfigValue($value = '') {
        return $this->_scopeConfig->getValue($value, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
    
    public function enablePromobar()
    {
        return $this->getConfigValue('promosection/generalgroup/enable');
    }
    
    public function enableHome()
    {
        return $this->getConfigValue('promosection/generalgroup/enablehome');
    }
    
    public function getBarStyle()
    {
        return $this->getConfigValue('promosection/generalgroup/barstyle');
    }
    
    public function enableSticky()
    {
        return $this->getConfigValue('promosection/generalgroup/sticky');
    }
    
    public function getEnableLoop()
    {
        return $this->getConfigValue('promosection/generalgroup/enable_loop');
    }
    
    public function getAutoplay()
    {
        return $this->getConfigValue('promosection/generalgroup/autoplay');
    }
    
    public function getStopHover()
    {
        return $this->getConfigValue('promosection/generalgroup/stoponhover');
    }
    
    public function getMouseDrag()
    {
        return $this->getConfigValue('promosection/generalgroup/mousedrag');
    }
    
    public function getTouchDrag()
    {
        return $this->getConfigValue('promosection/generalgroup/touchdrag');
    }
    
    public function getCloseBtnvisibility()
    {
        return $this->getConfigValue('promosection/generalgroup/closebtnvisibility');
    }

}
