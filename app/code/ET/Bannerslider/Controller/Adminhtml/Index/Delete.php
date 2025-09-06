<?php

namespace ET\Bannerslider\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;

class Delete extends Action {

    /**
     * @var \ET\Bannerslider\Model\Banner
     */
    protected $modelBanner;

    /**
     * @param Context $context
     * @param \ET\Bannerslider\Model\Banner $bannerFactory
     */
    public function __construct(
    \Magento\Backend\App\Action\Context $context, \ET\Bannerslider\Model\Banner $bannerFactory
    ) {
        parent::__construct($context);
        $this->modelBanner = $bannerFactory;
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed() {
        return $this->_authorization->isAllowed('ET_Bannerslider::index_delete');
    }

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute() {
        $id = $this->getRequest()->getParam('id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $model = $this->modelBanner;
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccess(__('Record deleted successfully.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }
        $this->messageManager->addError(__('Record does not exist.'));
        return $resultRedirect->setPath('*/*/');
    }

}
