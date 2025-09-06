<?php

namespace ET\Productnavigation\Model\Config\Source;

/**
 * Display mode
 *
 */
class Navposition implements \Magento\Framework\Option\ArrayInterface {

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray() {
        return [
            ['value' => 'left', 'label' => __('Left')],
            ['value' => 'right', 'label' => __('Right')],
            ['value' => 'center', 'label' => __('Center')],
            ['value' => 'fullwidth', 'label' => __('Full Width')],
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
