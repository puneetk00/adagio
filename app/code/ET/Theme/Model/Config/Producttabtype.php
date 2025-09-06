<?php

namespace ET\Theme\Model\Config;

class Producttabtype implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function toOptionArray()
    {
        return [
            ['value' => 'attribute', 'label' => __('Attribute')],
            ['value' => 'cmsblock', 'label' => __('CMS Block')]
        ];
    }
}
