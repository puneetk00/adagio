<?php

namespace ET\Theme\Model\Config;

class Demoversion implements \Magento\Framework\Option\ArrayInterface {

    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function toOptionArray() {
        return [
            ['value' => '0', 'label' => __('All')],
            ['value' => 'demo01', 'label' => __('Demo 1 - Fashion')],
            ['value' => 'demo02', 'label' => __('Demo 2 - Grocery')],
            ['value' => 'demo03', 'label' => __('Demo 3 - Autoparts')],
            ['value' => 'demo04', 'label' => __('Demo 4 - Electronics')],
            ['value' => 'demo05', 'label' => __('Demo 5 - KidsToys')],
            ['value' => 'demo06', 'label' => __('Demo 6 - Perfume')],
            ['value' => 'demo07', 'label' => __('Demo 7 - Furniture')],
            ['value' => 'demo08', 'label' => __('Demo 8 - Winestore')],
            ['value' => 'demo09', 'label' => __('Demo 9 - Health')],
            ['value' => 'demo10', 'label' => __('Demo 10 - FastFood')],
            ['value' => 'demo11', 'label' => __('Demo 11 - Fashion')],
            ['value' => 'demo12', 'label' => __('Demo 12 - Electronics')],
            ['value' => 'demo13', 'label' => __('Demo 13 - Vitamin')],
            ['value' => 'demo14', 'label' => __('Demo 14 - GymSpa')],
            ['value' => 'demo15', 'label' => __('Demo 15 - Cosmetics')],
            ['value' => 'demo16', 'label' => __('Demo 16 - Bookstore')],
            ['value' => 'demo17', 'label' => __('Demo 17 - Jewelry')],
            ['value' => 'demo18', 'label' => __('Demo 18 - Bicycle')],
            ['value' => 'demo19', 'label' => __('Demo 19 - E-Vehicle')],
            ['value' => 'demo20', 'label' => __('Demo 20 - SmartWatch')],
            ['value' => 'demo21', 'label' => __('Demo 21 - Sports')],
            ['value' => 'demo22', 'label' => __('Demo 22 - Flowershop')]
        ];
    }

}
