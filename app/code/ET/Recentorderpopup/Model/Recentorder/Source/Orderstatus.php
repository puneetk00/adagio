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
class Orderstatus implements OptionSourceInterface {

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
                'value' => 0,
                'label' => __('All')
            ],
            [
                'value' => 1,
                'label' => __('Only Completed')
            ],
        ];
        return $options;
    }

}
