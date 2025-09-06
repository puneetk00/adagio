<?php

namespace ET\Theme\Plugin\Result;

use Magento\Framework\App\ResponseInterface;

class Page {

    private $context;
    private $_baseHelper;

    public function __construct(
        \Magento\Framework\View\Element\Context $context,
        \ET\Base\Helper\Data $baseHelper
    ) {
        $this->context = $context;
        $this->_baseHelper = $baseHelper;
    }

    public function beforeRenderResult(
        \Magento\Framework\View\Result\Page $subject, ResponseInterface $response
    ) {
        
        $enableCheckoutDesign = $this->_baseHelper->getConfigValue('checkout_section/general/enabled');
        if($enableCheckoutDesign == 1) {
            if ($this->context->getRequest()->getFullActionName() == 'checkout_index_index') {
                $subject->getConfig()->addBodyClass('checkout-design');
            }
        }

        return [$response];
    }

}