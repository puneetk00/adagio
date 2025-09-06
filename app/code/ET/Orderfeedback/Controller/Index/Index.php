<?php

namespace ET\Orderfeedback\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action {

    protected $_orderfeedbackHelper;
    protected $_feedbackFactory;
    protected $storeManager;
    protected $_order;

    public function __construct(
        \Magento\Backend\App\Action\Context $context, 
        \ET\Orderfeedback\Helper\Data $orderfeedbackHelper,
        \ET\Orderfeedback\Model\FeedbackFactory $feedbackFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Sales\Model\Order $order
    ) {
        $this->_orderfeedbackHelper = $orderfeedbackHelper;
        $this->_feedbackFactory = $feedbackFactory;
        $this->storeManager = $storeManager;
        $this->_order = $order;
        parent::__construct($context);
    }

    public function execute() {

        $post = $this->getRequest()->getPostValue();
        if ($post && count($post) > 0) {
            $orderId = $this->getRequest()->getPost('order_id');
            $orderRating = $this->getRequest()->getPost('order_rating');
            $orderComment = $this->getRequest()->getPost('order_comment');

            $order = $this->_order->loadByIncrementId($orderId);
            $customerEmail = $order->getBillingAddress()->getEmail();
            $customerFirstname = $order->getBillingAddress()->getFirstname();
            $customerLastname = $order->getBillingAddress()->getLastname();
            $customerName = $customerFirstname . ' ' . $customerLastname;
            $customerId = $order->getCustomerId();
            
            $storeId = $this->storeManager->getStore()->getId();

            $orderFeedbackData = $this->_feedbackFactory->create();
            $orderFeedbackData->setOrderId($orderId);
            $orderFeedbackData->setRating($orderRating);
            $orderFeedbackData->setCustomerEmail($customerEmail);
            $orderFeedbackData->setCustomerName($customerName);
            $orderFeedbackData->setCustomerId($customerId);
            $orderFeedbackData->setContent($orderComment);
            $orderFeedbackData->setStoreId($storeId);
            $orderFeedbackData->save();
            
            $feedbackData['order_id'] = $orderId;
            $feedbackData['order_rating'] = $orderRating;
            $feedbackData['order_comment'] = $orderComment;
            $feedbackData['customer_email'] = $customerEmail;
            $feedbackData['customer_id'] = $customerId;

            $emailEnabled = $this->_orderfeedbackHelper->getConfigValue('orderfeedback/settings/email_enabled');
            $sendEmptyEmail = $this->_orderfeedbackHelper->getConfigValue('orderfeedback/settings/send_empty_email');

            if ($emailEnabled == 1) {
                $emailVars = array();
                $emailVars = $feedbackData;
                if ($sendEmptyEmail == 1) {
                    $this->_orderfeedbackHelper->sendMail($emailVars);
                } else {
                    if ($orderComment != '') {
                        $this->_orderfeedbackHelper->sendMail($emailVars);
                    }
                }
            }

            $responseArry['result'] = 'success';
            echo json_encode($responseArry);
            exit;
        }

        $this->_view->loadLayout();
        $this->_view->getLayout()->initMessages();
        $this->_view->renderLayout();
    }

}
