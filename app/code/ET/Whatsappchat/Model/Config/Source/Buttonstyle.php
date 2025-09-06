<?php

namespace ET\Whatsappchat\Model\Config\Source;

/**
 * Display mode
 *
 */
class Buttonstyle implements \Magento\Framework\Option\ArrayInterface {

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray() {
        return [
            ['value' => 'whatschat_style_1', 'label' => __('Icon and Text')],
            ['value' => 'whatschat_style_2', 'label' => __('Icon Only')],
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
