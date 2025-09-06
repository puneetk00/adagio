<?php

namespace ET\Clientreviews\Model\Config;

class Demoversion implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
        return [
            ['value' => '1', 'label' => __('Demo 1')],
            ['value' => '2', 'label' => __('Demo 2')],
            ['value' => '3', 'label' => __('Demo 3')],
            ['value' => '4', 'label' => __('Demo 4')],
            ['value' => '5', 'label' => __('Demo 5')],
            ['value' => '6', 'label' => __('Demo 6')],
            ['value' => '7', 'label' => __('Demo 7')],
            ['value' => '8', 'label' => __('Demo 8')],
            ['value' => '9', 'label' => __('Demo 9')],
            ['value' => '10', 'label' => __('Demo 10')],
            ['value' => '11', 'label' => __('Demo 11')],
            ['value' => '12', 'label' => __('Demo 12')],
            ['value' => '13', 'label' => __('Demo 13')],
            ['value' => '14', 'label' => __('Demo 14')]
        ];
    }
}