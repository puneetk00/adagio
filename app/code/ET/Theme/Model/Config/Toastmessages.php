<?php

namespace ET\Theme\Model\Config;

class Toastmessages implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function toOptionArray()
    {
        return [
            ['value' => 'disabled', 'label' => __('Disabled')],
            ['value' => 'onlyhome', 'label' => __('Only on Home Page')],
            ['value' => 'allpages', 'label' => __('All Pages')]
        ];
    }
}
