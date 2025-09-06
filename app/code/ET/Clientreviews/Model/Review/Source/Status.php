<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace ET\Clientreviews\Model\Review\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class IsActive
 */
class Status implements OptionSourceInterface {

    /**
     * @var \Magento\Cms\Model\Page
     */
    protected $reviewModel;

    /**
     * Constructor
     *
     * @param \ET\Clientreviews\Model\Review
     */
    public function __construct(\ET\Clientreviews\Model\Review $reviewModel) {
        $this->reviewModel = $reviewModel;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray() {
        $availableOptions = $this->reviewModel->getAvailableStatuses();
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
