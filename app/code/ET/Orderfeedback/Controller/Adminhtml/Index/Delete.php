<?php

namespace ET\Orderfeedback\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;

class Delete extends Action {

    /**
     * @var \ET\Orderfeedback\Model\Feedback
     */
    protected $modelFeedback;

    /**
     * @param Context $context
     * @param \ET\Orderfeedback\Model\Feedback $feedbackFactory
     */
    public function __construct(
    \Magento\Backend\App\Action\Context $context, \ET\Orderfeedback\Model\Feedback $feedbackFactory
    ) {
        parent::__construct($context);
        $this->modelFeedback = $feedbackFactory;
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed() {
        return $this->_authorization->isAllowed('ET_Orderfeedback::index_delete');
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
                $model = $this->modelFeedback;
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
