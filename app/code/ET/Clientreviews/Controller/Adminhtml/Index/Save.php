<?php

namespace ET\Clientreviews\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\Model\Session;
use ET\Clientreviews\Model\Review;
use ET\Clientreviews\Model\ImageUploader;
use Magento\Framework\Stdlib\DateTime;

class Save extends \Magento\Backend\App\Action {

    /**
     * @var Review
     */
    protected $reviewmodel;

    /**
     * @var Session
     */
    protected $adminsession;

    /**
     * @var profile_imgUploader
     */
    private $profile_imgUploader;

    /**
     * @var DateTime
     */
    protected $dateTime;

    /**
     * @param Action\Context $context
     * @param Review           $reviewmodel
     * @param Session        $adminsession
     */
    public function __construct(
    Action\Context $context, Review $reviewmodel, Session $adminsession, DateTime $dateTime, ImageUploader $profile_imgUploader
    ) {
        parent::__construct($context);
        $this->reviewmodel = $reviewmodel;
        $this->adminsession = $adminsession;
        $this->profile_imgUploader = $profile_imgUploader;
        $this->dateTime = $dateTime;
    }

    /**
     * Save review record action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute() {
        $data = $this->getRequest()->getPostValue();

        $resultRedirect = $this->resultRedirectFactory->create();

        if ($data) {
            $id = $this->getRequest()->getParam('id');
            if ($id) {
                $this->reviewmodel->load($id);
            }

            // Set Image Name
            if (isset($data['profile_img'][0]['name']) && isset($data['profile_img'][0]['tmp_name'])) {
                $data['profile_img'] = $data['profile_img'][0]['name'];
                $this->profile_imgUploader->moveFileFromTmp($data['profile_img']);
            } elseif (isset($data['profile_img'][0]['name']) && !isset($data['profile_img'][0]['tmp_name'])) {
                $data['profile_img'] = $data['profile_img'][0]['name'];
            } else {
                $data['profile_img'] = '';
            }

            $this->reviewmodel->setData($data);

            try {
                $this->reviewmodel->save();
                $this->messageManager->addSuccess(__('The data has been saved.'));
                $this->adminsession->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    if ($this->getRequest()->getParam('back') == 'add') {
                        return $resultRedirect->setPath('*/*/add');
                    } else {
                        return $resultRedirect->setPath('*/*/edit', ['id' => $this->reviewmodel->getId(), '_current' => true]);
                    }
                }

                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the data.'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }

        return $resultRedirect->setPath('*/*/');
    }

}
