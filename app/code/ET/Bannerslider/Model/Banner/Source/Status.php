<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace ET\Bannerslider\Model\Banner\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class IsActive
 */
class Status implements OptionSourceInterface {

    /**
     * @var \Magento\Cms\Model\Page
     */
    protected $bannerModel;

    /**
     * Constructor
     *
     * @param \ET\Bannerslider\Model\Banner
     */
    public function __construct(\ET\Bannerslider\Model\Banner $bannerModel) {
        $this->bannerModel = $bannerModel;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray() {
        $availableOptions = $this->bannerModel->getAvailableStatuses();
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
