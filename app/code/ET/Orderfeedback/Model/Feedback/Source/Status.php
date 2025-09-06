<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace ET\Orderfeedback\Model\Feedback\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class IsActive
 */
class Status implements OptionSourceInterface {

    /**
     * @var \Magento\Cms\Model\Page
     */
    protected $feedbackModel;

    /**
     * Constructor
     *
     * @param \ET\Orderfeedback\Model\Feedback
     */
    public function __construct(\ET\Orderfeedback\Model\Feedback $feedbackModel) {
        $this->feedbackModel = $feedbackModel;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray() {
        $availableOptions = $this->feedbackModel->getAvailableStatuses();
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
