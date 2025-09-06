<?php

namespace ET\Theme\Model\Config;

class Menutype implements \Magento\Framework\Option\ArrayInterface {

    public function toOptionArray() {
        return [
            ['value' => 'fullwidth', 'label' => __('Full Width')],
            ['value' => 'staticwidth', 'label' => __('Static Width')],
            ['value' => 'classic', 'label' => __('Classic')]
        ];
    }
}
