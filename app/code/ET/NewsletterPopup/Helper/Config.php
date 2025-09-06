<?php

namespace ET\NewsletterPopup\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;

class Config extends AbstractHelper {

    const BASE_CONFIG_XML_PREFIX = 'addonnewspopup/settings/%s';
    const ENABLED = 'enabled';
    const USE_AJAX = 'use_ajax';
    const POPUP_DELAY = 'popup_delay';
    const POPUP_TITLE = 'popup_title';
    const POPUP_TEXT = 'popup_text';
    const CUSTOM_POPUP_TEXT = 'popup_custom_text';
    const DEMO_LAYOUT = 'demo_layout';
    const TEMPLATE_MODE = 'template_mode';
    const ENABLE_HOMEPAGE = 'enable_homepage';
    const POPUP_DIMENSION = 'popup_dimension';
    const POPUP_WIDTH = 'popup_width';
    const POPUP_HEIGHT = 'popup_height';
    const CUSTOM_CSS = 'custom_css';

    /**
     * @param Context $context
     */
    public function __construct(Context $context) {
        parent::__construct($context);
    }

    /**
     * Return configuration param from module admin settings
     *
     * @param string $configField
     * @return mixed
     */
    public function getConfigValue($configField) {
        return $this->scopeConfig->getValue(sprintf(self::BASE_CONFIG_XML_PREFIX, $configField), \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

}
