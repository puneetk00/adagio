<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace ET\Promotionbar\Model\Promotion\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\Framework\View\Model\PageLayout\Config\BuilderInterface;

/**
 * Class PageLayout
 */
class Barstyle implements OptionSourceInterface {

    const SKINNY = 1;
    const THIN = 2;
    const REGULAR = 3;
    const TALL = 4;

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
                'value' => self::SKINNY,
                'label' => __('Skinny')
            ],
            [
                'value' => self::THIN,
                'label' => __('Thin')
            ],
            [
                'value' => self::REGULAR,
                'label' => __('Regular')
            ],
            [
                'value' => self::TALL,
                'label' => __('Tall')
            ],
        ];
        return $options;
    }

}
