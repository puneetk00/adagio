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
class UrlTarget implements OptionSourceInterface {

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
            'label' => 'New Tab',
            'value' => '1',
        ];
        $options[] = [
            'label' => 'Same Tab',
            'value' => '2',
        ];
        $this->options = $options;

        return $options;
    }

}
