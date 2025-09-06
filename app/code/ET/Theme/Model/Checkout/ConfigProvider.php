<?php

namespace Et\Theme\Model\Checkout;

use Magento\Checkout\Model\ConfigProviderInterface;
use Magento\Framework\View\LayoutInterface;

class ConfigProvider implements ConfigProviderInterface
{
    protected $_layout;
    private $_baseHelper;

    public function __construct(
        LayoutInterface $layout,
        \ET\Base\Helper\Data $baseHelper
    ){
        $this->_layout = $layout;
        $this->_baseHelper = $baseHelper;
    }

    public function getConfig()
    {
        $checkoutSidebarBlock = $enableCheckoutDesign = $this->_baseHelper->getConfigValue('checkout_section/general/checkout_sidebar');
        $checkoutBottomBlock = $enableCheckoutDesign = $this->_baseHelper->getConfigValue('checkout_section/general/checkout_bottom');

        return [
            'checkout_sidebar_block' => $this->_layout->createBlock('Magento\Cms\Block\Block')->setBlockId($checkoutSidebarBlock)->toHtml(),
            'checkout_bottom_block' => $this->_layout->createBlock('Magento\Cms\Block\Block')->setBlockId($checkoutBottomBlock)->toHtml()
        ];
    }
}