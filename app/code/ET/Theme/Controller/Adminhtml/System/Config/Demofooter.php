<?php

namespace ET\Theme\Controller\Adminhtml\System\Config;

abstract class Demofooter extends \Magento\Backend\App\Action {
    protected function _import()
    {
        return $this->_objectManager->get('ET\Theme\Model\Import\Demofooter')
            ->importDemo($this->getRequest()->getParam('demo_version'),$this->getRequest()->getParam('current_store'),$this->getRequest()->getParam('current_website'));
    }
}
