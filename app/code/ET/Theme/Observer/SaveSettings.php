<?php

namespace ET\Theme\Observer;

use Magento\Framework\Event\ObserverInterface;

class SaveSettings implements ObserverInterface {
    protected $_messageManager;
    protected $_cssGenerator;
    
    public function __construct(
        \ET\Theme\Model\CssSetting\Generator $cssgenerator,
        \Magento\Framework\Message\ManagerInterface $messageManager
    ) 
    {    
        $this->_cssGenerator = $cssgenerator;
        $this->_messageManager = $messageManager;
    }
    
    public function execute(
        \Magento\Framework\Event\Observer $observer
    )
    {
        $message = 'Save';
        $this->_cssGenerator->generateCss('settings',$observer
            ->getData("website"),$observer->getData("store"));
    }
}