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
class DisableMobile implements OptionSourceInterface {

    /**
     * Retrieve status options array.
     *
     * @return array
     */
    public function toOptionArray() {
        return [
            ['value' => 0, 'label' => __('No')],
            ['value' => 1, 'label' => __('Yes')]
        ];
    }

}
