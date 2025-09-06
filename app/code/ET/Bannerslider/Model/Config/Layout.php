<?php

namespace ET\Bannerslider\Model\Config;

class Layout implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function toOptionArray()
    {        
        return [
            ['value' => 'full', 'label' => __('Full Width')],
            ['value' => 'box', 'label' => __('Boxed Width')],
        ];
    }
}
