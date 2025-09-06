<?php

namespace ET\NewsletterPopup\Model\Config\Source;

/**
 * Display mode
 *
 */
class TemplateMode implements \Magento\Framework\Option\ArrayInterface {

    /**
     * @const string
     */
    const READYMADE = 0;

    /**
     * @const string
     */
    const CUSTOM = 1;

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray() {
        return [
            ['value' => self::READYMADE, 'label' => __('Ready Made Template')],
            ['value' => self::CUSTOM, 'label' => __('Custom')],
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
