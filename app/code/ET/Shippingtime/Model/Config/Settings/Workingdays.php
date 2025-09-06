<?php

namespace ET\Shippingtime\Model\Config\Settings;

class Workingdays implements \Magento\Framework\Option\ArrayInterface {

    public function toOptionArray() {
        return [
            ['value' => '5', 'label' => __('5 Days - Monday to Friday')],
            ['value' => '6', 'label' => __('6 Days - Monday to Saturday')],
            ['value' => '7', 'label' => __('7 Days - Monday to Sunday')]
        ];
    }

    public function toArray() {
        return [
            '5' => __('5 Days - Monday to Friday'),
            '6' => __('6 Days - Monday to Saturday'),
            '7' => __('7 Days - Monday to Sunday')
        ];
    }

}
