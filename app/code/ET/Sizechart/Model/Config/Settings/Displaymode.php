<?php

namespace ET\Sizechart\Model\Config\Settings;

class Displaymode implements \Magento\Framework\Option\ArrayInterface {

    public function toOptionArray() {
        return [
            ['value' => '1', 'label' => __('Display In Popup')],
            ['value' => '2', 'label' => __('Display With Product Content')]
        ];
    }

    public function toArray() {
        return [
            '1' => __('Display In Popup'),
            '2' => __('Display With Product Content')
        ];
    }

}
