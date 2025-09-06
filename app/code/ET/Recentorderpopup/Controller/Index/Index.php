<?php

namespace ET\Recentorderpopup\Controller\Index;

use Magento\Directory\Api\CountryInformationAcquirerInterface;

class Index extends \Magento\Framework\App\Action\Action {

    protected $helper;
    protected $_orderCollectionFactory;
    protected $_productFactory;
    protected $_orderRepository;
    protected $countryInformationAcquirerInterface;

    public function __construct(
    \Magento\Backend\App\Action\Context $context, \ET\Base\Helper\Data $helper, \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory, \Magento\Catalog\Model\ProductFactory $productFactory, \Magento\Sales\Api\OrderRepositoryInterface $orderRepository, CountryInformationAcquirerInterface $countryInformationAcquirerInterface
    ) {
        $this->helper = $helper;
        $this->_orderCollectionFactory = $orderCollectionFactory;
        $this->_productFactory = $productFactory;
        $this->_orderRepository = $orderRepository;
        $this->countryInformationAcquirerInterface = $countryInformationAcquirerInterface;
        parent::__construct($context);
    }

    public function execute() {
        $productImgUrl = '';
        $message = '';
        $resArray = array();
        $isFakeOrders = $this->helper->getConfigValue('recentordersection/fakeordergroup/fake_orders');
        $orderStatus = $this->helper->getConfigValue('recentordersection/generalgroup/orderstatus');
        $orderCount = $this->helper->getConfigValue('recentordersection/generalgroup/recent_order_count');
        $messageTemplate = $this->helper->getConfigValue('recentordersection/generalgroup/message_template');

        if ($isFakeOrders) {
            $fakeCustomerName = $this->helper->getConfigValue('recentordersection/fakeordergroup/fake_customer_name');
            $fakeCountry = $this->helper->getConfigValue('recentordersection/fakeordergroup/fake_country');
            $fakeProducts = $this->helper->getConfigValue('recentordersection/fakeordergroup/fake_products');
            $fakeTime = $this->helper->getConfigValue('recentordersection/fakeordergroup/fake_time');

            $customerName = $this->getRandom($fakeCustomerName);
            $country = $this->getRandom($fakeCountry);
            $productId = $this->getRandom($fakeProducts);
            $time = $this->getRandom($fakeTime);

            $productData = $this->getProductById($productId);

            $productName = $productData->getName();
            $productUrl = $productData->getProductUrl();
            $productImg = $productData->getData('image');
            $productImgUrl = '';
            if ($productImg) {
                $mediaUrl = $this->helper->getMediaUrl() . "catalog/product";
                $productImgUrl = $mediaUrl . $productImg;
            }

            $paramArray = array();
            $paramArray['product_name'] = $productName;
            $paramArray['product_image'] = $productImgUrl;
            $paramArray['product_url'] = $productUrl;
            $paramArray['customer_name'] = $customerName;
            $paramArray['country'] = $country;
            $paramArray['time'] = $time;

            $message = $this->replacePlaceholders($messageTemplate, $paramArray);
        } else {
            // Get order collection and then pick one randomly
            $paramArray = $this->getOrderCollection($orderStatus, $orderCount);
            if ($paramArray && count($paramArray) > 0) {
                $productImgUrl = $paramArray['product_image'];
                $message = $this->replacePlaceholders($messageTemplate, $paramArray);
            }
        }

        $resArray['product_img'] = $productImgUrl;
        $resArray['message'] = $message;
        $resArray = json_encode($resArray);
        echo $resArray;
        exit;
    }

    public function getProductById($sku) {
        $product = $this->_productFactory->create();
        $product->load($product->getIdBySku($sku));
        return $product;
    }

    public function getOrderById($orderId) {

        $productId = 0;
        $orderDetails = array();
        $order = $this->_orderRepository->get($orderId);

        // Get Order Customer Name and Country
        $customerName = $order->getCustomerFirstname() . " " . $order->getCustomerLastname();
        $countryId = $order->getBillingAddress()->getCountryId();
        $country = $this->getCountryName($countryId);
        $orderCreatedAt = $order->getCreatedAt();

        // Get Order Item Id
        $items = $order->getAllVisibleItems();
        foreach ($items as $item) {
            $productId = $item->getSku();
            break;
        }

        // Set product data
        $productData = $this->getProductById($productId);
        $productName = $productData->getName();
        $productUrl = $productData->getProductUrl();
        $productImg = $productData->getData('image');
        $productImgUrl = '';
        if ($productImg) {
            $mediaUrl = $this->helper->getMediaUrl() . "catalog/product";
            $productImgUrl = $mediaUrl . $productImg;
        }
        $orderDetails['product_name'] = $productName;
        $orderDetails['product_image'] = $productImgUrl;
        $orderDetails['product_url'] = $productUrl;
        $orderDetails['customer_name'] = $customerName;
        $orderDetails['country'] = $country;
        $orderDetails['time'] = $this->timeElapsedString($orderCreatedAt);

        return $orderDetails;
    }

    public function getCountryName($countryCode, $type = "local") {
        $countryName = null;
        try {
            $data = $this->countryInformationAcquirerInterface->getCountryInfo($countryCode);
            if ($type == "local") {
                $countryName = $data->getFullNameLocale();
            } else {
                $countryName = $data->getFullNameLocale();
            }
        } catch (NoSuchEntityException $e) {
            
        }
        return $countryName;
    }

    public function getOrderCollection($status, $limit = 5) {
        $orderDetails = array();
        $collection = $this->_orderCollectionFactory->create()
                ->addAttributeToSelect('entity_id')
                ->setOrder('created_at', 'desc');
        if ($status == 1) {
            $collection->addFieldToFilter('status', ['in' => array('complete')]);
        }
        $collection->setPageSize($limit)
                ->setCurPage(1)
                ->load();

        $orders = $collection->getData();
        if ($orders && count($orders) > 0) {
            $order = $orders[array_rand($orders)];
            if (isset($order['entity_id'])) {
                $orderId = $order['entity_id'];
                $orderDetails = $this->getOrderById($orderId);
            }
        }

        return $orderDetails;
    }

    public function getRandom($str) {
        $element = '';
        if ($str != '') {
            $strArray = explode(',', $str);
            $element = $strArray[array_rand($strArray)];
        }
        return $element;
    }

    public function replacePlaceholders($body, array $vars) {
        foreach ($vars as $key => $value) {
            $placeholder = sprintf('{{%s}}', $key);
            if ($value) {
                $body = str_replace($placeholder, $value, $body);
            }
        }
        return $body;
    }

    function timeElapsedString($eventTime) {
        $totaldelay = time() - strtotime($eventTime);
        if ($totaldelay <= 0) {
            return '';
        } else {
            if ($days = floor($totaldelay / 86400)) {
                $totaldelay = $totaldelay % 86400;
                return $days . ' days ago.';
            }
            if ($hours = floor($totaldelay / 3600)) {
                $totaldelay = $totaldelay % 3600;
                return $hours . ' hours ago.';
            }
            if ($minutes = floor($totaldelay / 60)) {
                $totaldelay = $totaldelay % 60;
                return $minutes . ' minutes ago.';
            }
            if ($seconds = floor($totaldelay / 1)) {
                $totaldelay = $totaldelay % 1;
                return $seconds . ' seconds ago.';
            }
        }
    }

//    public function timeElapsedString($datetime, $full = false) {
//        $now = new \DateTime;
//        $ago = new \DateTime($datetime);
//        $diff = $now->diff($ago);
//
//        $diff->w = floor($diff->d / 7);
//        $diff->d -= $diff->w * 7;
//
//        $string = array(
//            'y' => 'year',
//            'm' => 'month',
//            'w' => 'week',
//            'd' => 'day',
//            'h' => 'hour',
//            'i' => 'minute',
//            's' => 'second',
//        );
//
//        foreach ($string as $k => &$v) {
//            if ($diff->$k) {
//                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
//            } else {
//                unset($string[$k]);
//            }
//        }
//
//        if (!$full) {
//            $string = array_slice($string, 0, 1);
//        }
//        return $string ? implode(', ', $string) . ' ago' : 'just now';
//    }
}
