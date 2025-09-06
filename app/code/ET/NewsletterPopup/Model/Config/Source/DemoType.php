<?php

namespace ET\NewsletterPopup\Model\Config\Source;

/**
 * Display mode
 *
 */
class DemoType implements \Magento\Framework\Option\ArrayInterface {

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray() {
        return [
            ['value' => '1', 'label' => __('Demo 01')],
            ['value' => '2', 'label' => __('Demo 02')],
            ['value' => '3', 'label' => __('Demo 03')],
        ];
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray() {
        $array = [];
        foreach ($this->toOptionArray() as $item) {
            $array[$item['value']] = $item['label'];
        }
        return $array;
    }

}
