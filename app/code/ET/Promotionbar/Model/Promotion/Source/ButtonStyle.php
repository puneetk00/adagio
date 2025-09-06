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
class ButtonStyle implements OptionSourceInterface {

    /**
     * @var array
     * @deprecated 103.0.1 since the cache is now handled by \Magento\Theme\Model\PageLayout\Config\Builder::$configFiles
     */
    protected $options;

    /**
     * @inheritdoc
     */
    public function toOptionArray() {
        $options = [];
        $options[] = [
            'label' => 'Rounded',
            'value' => '1',
        ];
        $options[] = [
            'label' => 'Pill',
            'value' => '2',
        ];
        $options[] = [
            'label' => 'Square',
            'value' => '3',
        ];
        $options[] = [
            'label' => 'Outline',
            'value' => '4',
        ];
        $this->options = $options;

        return $options;
    }

}
