<?php

namespace ET\Theme\Model\Config;

class Maxwidth implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function toOptionArray()
    {
        return [
            ['value' => '1170', 'label' => __('1170 (Default)')],
            ['value' => '1280', 'label' => __('1280')],
        ];
    }
}
