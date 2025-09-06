<?php

namespace ET\Promotionbar\Model\Promotion\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\Framework\View\Model\PageLayout\Config\BuilderInterface;

/**
 * Class PageLayout
 */
class Closebtnvisibility implements OptionSourceInterface {

    const ONHOVER = 1;
    const ALWAYSSHOW = 2;
    const ALWAYSHIDE = 3;

    protected $options;

    /**
     * @inheritdoc
     */
    public function toOptionArray() {
        $options = [
            [
                'value' => self::ONHOVER,
                'label' => __('On Hover')
            ],
            [
                'value' => self::ALWAYSSHOW,
                'label' => __('Always Show')
            ],
            [
                'value' => self::ALWAYSHIDE,
                'label' => __('Always Hide')
            ],
        ];
        return $options;
    }

}
