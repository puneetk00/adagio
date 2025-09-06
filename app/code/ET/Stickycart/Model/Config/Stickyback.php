<?php

namespace ET\Stickycart\Model\Config;

class Stickyback implements \Magento\Framework\Option\ArrayInterface {

    public function toOptionArray() {
        return [
            ['value' => '1', 'label' => __('Plain Color Background')],
            ['value' => '2', 'label' => __('Gradient Background')]
        ];
    }

    public function toArray() {
        return [
            '1' => __('Plain Color Background'),
            '2' => __('Gradient Background')
        ];
    }

}
