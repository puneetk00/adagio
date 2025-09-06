<?php

namespace ET\Recentorderpopup\Block\Index;

class Index extends \Magento\Framework\View\Element\Template {

    protected $_registry;
    protected $_request;

    public function __construct(
    \Magento\Backend\Block\Template\Context $context, \Magento\Framework\Registry $registry, \Magento\Framework\App\Request\Http $request, array $data = []
    ) {
        $this->_registry = $registry;
        $this->_request = $request;
        parent::__construct($context, $data);
    }

    protected function _prepareLayout() {
        return parent::_prepareLayout();
    }

}
