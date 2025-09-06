<?php

namespace ET\Theme\Model\Config;

class Productcolumns implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function toOptionArray()
    {
        return [
            ['value' => '3', 'label' => __('3 Columns')],
            ['value' => '4', 'label' => __('4 Columns')],
            ['value' => '5', 'label' => __('5 Columns')],
            ['value' => '6', 'label' => __('6 Columns')]
        ];
    }
}
