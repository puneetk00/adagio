<?php

namespace ET\Theme\Model\Config;

class Cookieboxtype implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function toOptionArray()
    {
        return [
            ['value' => 'fullwidth', 'label' => __('Full Width')],
            ['value' => 'boxed', 'label' => __('Boxed')],
        ];
    }
}
