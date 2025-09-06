<?php

namespace ET\Theme\Model\Config;

class Buttonposition implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function toOptionArray()
    {
        return [
            ['value' => 'left', 'label' => __('Left')],
            ['value' => 'right', 'label' => __('Right')],
        ];
    }
}
