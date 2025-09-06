<?php

namespace ET\Shippingtime\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper {

    protected $_storeManager;

    public function __construct(
    \Magento\Framework\App\Helper\Context $context, \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->_storeManager = $storeManager;
        parent::__construct($context);
    }

    public function getFinalDeliveryDate($shippingDate, $dateFormat, $holidays = array(), $shippingDays = 4, $workingDays = 5) {
        if (!empty($shippingDate)) {
            $counter1 = 0;
            $incrementedDate = '';
            for ($i = 1; $i <= $shippingDays; $i++) {
                $date = strtotime("+$i day", strtotime($shippingDate));
                $dayName = date("D", $date);
                $incrementedDate = date("Y-m-d", $date);
                if ($workingDays == 5) {
                    if ($dayName == 'Sat' || $dayName == 'Sun' || in_array($incrementedDate, $holidays) == true) {
                        $counter1 += 1;
                    }
                } else if ($workingDays == 6) {
                    if ($dayName == 'Sun' || in_array($incrementedDate, $holidays) == true) {
                        $counter1 += 1;
                    }
                } else if ($workingDays == 7) {
                    if (in_array($incrementedDate, $holidays) == true) {
                        $counter1 += 1;
                    }
                }
            }
            if ($counter1 > 0) {
                return $this->getFinalDeliveryDate($incrementedDate, $dateFormat, $holidays, $counter1, $workingDays);
            } else {
                $incrementedDateTemp = strtotime($incrementedDate);
                return date($dateFormat, $incrementedDateTemp);
            }
        } else {
            return 'invalid';
        }
    }

}
