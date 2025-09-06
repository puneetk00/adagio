<?php

namespace ET\Promotionbar\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;

class Delete extends Action {

    /**
     * @var \ET\Promotionbar\Model\Promotion
     */
    protected $modelPromotion;

    /**
     * @param Context $context
     * @param \ET\Promotionbar\Model\Promotion $promotionFactory
     */
    public function __construct(
    \Magento\Backend\App\Action\Context $context, \ET\Promotionbar\Model\Promotion $promotionFactory
    ) {
        parent::__construct($context);
        $this->modelPromotion = $promotionFactory;
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed() {
        return $this->_authorization->isAllowed('ET_Promotionbar::index_delete');
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
                $model = $this->modelPromotion;
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
