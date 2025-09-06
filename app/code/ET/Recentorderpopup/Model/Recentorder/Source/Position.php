<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace ET\Recentorderpopup\Model\Recentorder\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\Framework\View\Model\PageLayout\Config\BuilderInterface;

/**
 * Class PageLayout
 */
class Position implements OptionSourceInterface {

    /**
     * @var array
     * @deprecated 103.0.1 since the cache is now handled by \Magento\Theme\Model\PageLayout\Config\Builder::$configFiles
     */
    protected $options;

    /**
     * @inheritdoc
     */
    public function toOptionArray() {
        $options = [
            [
                'value' => 'botton-left',
                'label' => __('Bottom Left')
            ],
            [
                'value' => 'bottom-right',
                'label' => __('Bottom Right')
            ],
            [
                'value' => 'top-left',
                'label' => __('Top Left')
            ],
            [
                'value' => 'top-right',
                'label' => __('Top Right')
            ],
        ];
        return $options;
    }

}
