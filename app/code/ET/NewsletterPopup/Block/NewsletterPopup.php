<?php

namespace ET\NewsletterPopup\Block;

use ET\NewsletterPopup\Helper\Config as NewsletterPopupConfig;
use Magento\Framework\View\Element\Template\Context;

class NewsletterPopup extends \Magento\Framework\View\Element\Template {

    /**
     * @var Context
     */
    protected $context;

    /**
     * @var NewsletterPopupConfig
     */
    protected $configHelper;

    /**
     * @var \Magento\Cms\Model\Template\FilterProvider
     */
    protected $filterProvider;
    protected $logoblock;

    /**
     * @param Context $context
     * @param NewsletterPopupConfig $configHelper
     * @param \Magento\Cms\Model\Template\FilterProvider $filterProvider
     */
    public function __construct(
        Context $context, 
        \Magento\Theme\Block\Html\Header\Logo $logoblock, 
        \Magento\Cms\Model\Template\FilterProvider $filterProvider, 
        NewsletterPopupConfig $configHelper
    ) {
        parent::__construct($context);
        $this->logoblock = $logoblock;
        $this->filterProvider = $filterProvider;
        $this->configHelper = $configHelper;
    }

    /**
     * Returns Newsletter Popup config
     *
     * @return array
     */
    public function getConfig() {
        return [
            'enabled' => $this->getEnabled(),
            'use_ajax' => $this->getUseAjax(),
            'delay' => $this->getPopupDelay(),
            'title' => $this->getPopupTitle(),
            'text' => $this->getPopupText(),
            'customtext' => $this->getCustomPopupText(),
            'demolayout' => $this->getDemoLayout(),
            'templatemode' => $this->getTemplateMode(),
            'enablehome' => $this->getEnableHomepage(),
            'dimension' => $this->getPopupDimension(),
            'width' => $this->getPopupWidth(),
            'height' => $this->getPopupHeight(),
        ];
    }

    /**
     * Newsletter Enabled.
     *
     * @return string
     */
    public function getEnabled() {
        return (string) $this->escapeHtml($this->configHelper->getConfigValue(NewsletterPopupConfig::ENABLED));
    }

    /**
     * Newsletter Use Ajax.
     *
     * @return string
     */
    public function getUseAjax() {
        return (string) $this->escapeHtml($this->configHelper->getConfigValue(NewsletterPopupConfig::USE_AJAX));
    }

    /**
     * Newsletter Popup Title.
     *
     * @return string
     */
    public function getPopupTitle() {
        return (string) $this->escapeHtml($this->configHelper->getConfigValue(NewsletterPopupConfig::POPUP_TITLE));
    }

    /**
     * Newsletter Popup Text.
     *
     * @return string
     */
    public function getPopupText() {
        $contentText = $this->configHelper->getConfigValue(NewsletterPopupConfig::POPUP_TEXT);
        $content = $this->filterProvider->getPageFilter()->filter($contentText);
        return $content;
    }

    /**
     * Newsletter Custom Popup Text.
     *
     * @return string
     */
    public function getCustomPopupText() {
        $contentText = $this->configHelper->getConfigValue(NewsletterPopupConfig::CUSTOM_POPUP_TEXT);
        $content = $this->filterProvider->getPageFilter()->filter($contentText);
        return $content;
    }

    /**
     * Newsletter Popup Delay.
     *
     * @return string
     */
    public function getPopupDelay() {
        return (string) $this->escapeHtml($this->configHelper->getConfigValue(NewsletterPopupConfig::POPUP_DELAY));
    }

    /**
     * Newsletter Enable Homepage.
     *
     * @return string
     */
    public function getEnableHomepage() {
        return (string) $this->escapeHtml($this->configHelper->getConfigValue(NewsletterPopupConfig::ENABLE_HOMEPAGE));
    }

    /**
     * Newsletter Template Mode.
     *
     * @return string
     */
    public function getTemplateMode() {
        return (string) $this->escapeHtml($this->configHelper->getConfigValue(NewsletterPopupConfig::TEMPLATE_MODE));
    }

    /**
     * Newsletter Demo Layout.
     *
     * @return string
     */
    public function getDemoLayout() {
        return (string) $this->escapeHtml($this->configHelper->getConfigValue(NewsletterPopupConfig::DEMO_LAYOUT));
    }

    /**
     * Newsletter Popup Dimension
     *
     * @return string
     */
    public function getPopupDimension() {
        return (string) $this->escapeHtml($this->configHelper->getConfigValue(NewsletterPopupConfig::POPUP_DIMENSION));
    }

    /**
     * Newsletter Popup Width
     *
     * @return string
     */
    public function getPopupWidth() {
        return (string) $this->escapeHtml($this->configHelper->getConfigValue(NewsletterPopupConfig::POPUP_WIDTH));
    }

    /**
     * Newsletter Popup Height
     *
     * @return string
     */
    public function getPopupHeight() {
        return (string) $this->escapeHtml($this->configHelper->getConfigValue(NewsletterPopupConfig::POPUP_HEIGHT));
    }

    public function getPopupDisplayText() {
        $popuptext = '';
        $templateMode = $this->getTemplateMode();
        if ($templateMode == 1) {
            $popuptext = $this->getCustomPopupText();
        } else {
            $popuptext = $this->getPopupText();
        }
        return $popuptext;
    }

    public function getIsHome() {
        return $this->logoblock->isHomePage();
    }

}
