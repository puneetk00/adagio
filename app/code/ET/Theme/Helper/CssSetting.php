<?php

namespace ET\Theme\Helper;

#[\AllowDynamicProperties]

class CssSetting extends \Magento\Framework\App\Helper\AbstractHelper {

    protected $_storeManager;
    protected $_generatedCssFolder;
    protected $_generatedCssPath;
    protected $_generatedCssDir;
    protected $_scopeConfig;
    protected $_coreRegistry;

    public function __construct(
    \Magento\Framework\App\Helper\Context $context, \Magento\Framework\Registry $coreRegistry, \Magento\Framework\UrlInterface $urlinterface, \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig, \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->_storeManager = $storeManager;
        $this->_urlinterface = $urlinterface;
        $this->_scopeConfig = $scopeConfig;
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

    public function getCurrentUrl() {
        return $this->_urlinterface->getCurrentUrl;
    }

    public function getCssConfigDir() {
        $base = BP;
        $generatedCssDir = $base . '/pub/media/etheme/generated_css/';
        return $$generatedCssDir;
    }

    public function getBaseMediaUrl() {
        return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    }

    public function getConfigValue($value = '') {
        return $this->_scopeConfig->getValue($value, \Magento\Store\Model\ScopeInterface::SCOPE_STORE, $this->_coreRegistry->registry('cssgen_store'));
    }

    public function getSettingsFile() {
        $base = BP;
        $generatedCssDir = $base . '/pub/media/etheme/generated_css/';
        $settingsFilePath = $generatedCssDir . 'settings_' . $this->_storeManager->getStore()->getCode() . '.css';
        if (file_exists($settingsFilePath)) {
            return $this->getBaseMediaUrl() . 'etheme/generated_css/' . 'settings_' . $this->_storeManager->getStore()->getCode() . '.css';
        } else {
            return 0;
        }
    }

    public function getMediaUrl() {
        return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    }

}
