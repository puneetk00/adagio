<?php

namespace ET\Theme\Controller\Adminhtml\System\Config;

abstract class Cms extends \Magento\Backend\App\Action {
    protected function _import()
    {
        return $this->_objectManager->get('ET\Theme\Model\Import\Cms')
            ->importCms($this->getRequest()->getParam('import_type'), $this->getRequest()->getParam('demo_version'));
    }
}
