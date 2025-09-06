<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace ET\Promotionbar\Model\Promotion\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class IsActive
 */
class Status implements OptionSourceInterface {

    /**
     * @var \Magento\Cms\Model\Page
     */
    protected $promotionModel;

    /**
     * Constructor
     *
     * @param \ET\Promotionbar\Model\Promotion
     */
    public function __construct(\ET\Promotionbar\Model\Promotion $promotionModel) {
        $this->promotionModel = $promotionModel;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray() {
        $availableOptions = $this->promotionModel->getAvailableStatuses();
        $options = [];
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }

}
