<?php

namespace ET\Bannerslider\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\Model\Session;
use ET\Bannerslider\Model\Banner;
use ET\Bannerslider\Model\ImageUploader;
use Magento\Framework\Stdlib\DateTime;

class Save extends \Magento\Backend\App\Action {

    /**
     * @var Banner
     */
    protected $bannermodel;

    /**
     * @var Session
     */
    protected $adminsession;

    /**
     * @var imgUploader
     */
    private $imgUploader;

    /**
     * @var DateTime
     */
    protected $dateTime;

    /**
     * @param Action\Context $context
     * @param Banner           $bannermodel
     * @param Session        $adminsession
     */
    public function __construct(
        Action\Context $context, 
        Banner $bannermodel, 
        Session $adminsession, 
        DateTime $dateTime, 
        ImageUploader $imgUploader
    ) {
        parent::__construct($context);
        $this->bannermodel = $bannermodel;
        $this->adminsession = $adminsession;
        $this->imgUploader = $imgUploader;
        $this->dateTime = $dateTime;
    }

    /**
     * Save banner record action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute() {
        $data = $this->getRequest()->getPostValue();

        $resultRedirect = $this->resultRedirectFactory->create();

        if ($data) {
            $id = $this->getRequest()->getParam('id');
            if ($id) {
                $this->bannermodel->load($id);
            }

            // Set Image Name
            if (isset($data['img'][0]['name']) && isset($data['img'][0]['tmp_name'])) {
                $data['img'] = $data['img'][0]['name'];
                $this->imgUploader->moveFileFromTmp($data['img']);
            } elseif (isset($data['img'][0]['name']) && !isset($data['img'][0]['tmp_name'])) {
                $data['img'] = $data['img'][0]['name'];
            } else {
                $data['img'] = '';
            }

            // Set Date Format
            if (isset($data['start_date']) && $data['start_date'] != '') {
                $data['start_date'] = $this->dateTime->formatDate($data['start_date']);
            }
            if (isset($data['end_date']) && $data['end_date'] != '') {
                $data['end_date'] = $this->dateTime->formatDate($data['end_date']);
            }

            $this->bannermodel->setData($data);

            try {
                $this->bannermodel->save();
                $this->messageManager->addSuccess(__('The data has been saved.'));
                $this->adminsession->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    if ($this->getRequest()->getParam('back') == 'add') {
                        return $resultRedirect->setPath('*/*/add');
                    } else {
                        return $resultRedirect->setPath('*/*/edit', ['id' => $this->bannermodel->getId(), '_current' => true]);
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
