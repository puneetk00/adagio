<?php

namespace ET\Clientreviews\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;

class Delete extends Action {

    /**
     * @var \ET\Clientreviews\Model\Review
     */
    protected $modelReview;

    /**
     * @param Context $context
     * @param \ET\Clientreviews\Model\Review $reviewFactory
     */
    public function __construct(
    \Magento\Backend\App\Action\Context $context, \ET\Clientreviews\Model\Review $reviewFactory
    ) {
        parent::__construct($context);
        $this->modelReview = $reviewFactory;
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed() {
        return $this->_authorization->isAllowed('ET_Clientreviews::index_delete');
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
                $model = $this->modelReview;
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
