<?php

namespace ET\Stickycart\Model\Config;

class Position implements \Magento\Framework\Option\ArrayInterface {

    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function toOptionArray() {
        return [
            ['value' => 'top', 'label' => __('Top')],
            ['value' => 'bottom', 'label' => __('Bottom')],
        ];
    }

}
