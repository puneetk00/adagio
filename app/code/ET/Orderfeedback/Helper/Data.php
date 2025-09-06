<?php

namespace ET\Orderfeedback\Helper;

use Psr\Log\LoggerInterface;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Translate\Inline\StateInterface;

class Data extends \Magento\Framework\App\Helper\AbstractHelper {

    protected $_storeManager;
    
    protected $logoblock;
    
    const EMAIL_TEMPLATE = 'orderfeedback/settings/email_template';
    
    /**
     * @var StateInterface
     */
    private $inlineTranslation;

    /**
     * @var TransportBuilder
     */
    private $transportBuilder;
    
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(
        \Magento\Framework\App\Helper\Context $context, 
        \Magento\Theme\Block\Html\Header\Logo $logoblock, 
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        TransportBuilder $transportBuilder, 
        StateInterface $inlineTranslation, 
        LoggerInterface $logger
    ) {
        $this->logoblock = $logoblock;
        $this->_storeManager = $storeManager;
        $this->transportBuilder = $transportBuilder;
        $this->inlineTranslation = $inlineTranslation;
        $this->logger = $logger;
        parent::__construct($context);
    }

    public function getIsHome() {
        return $this->logoblock->isHomePage();
    }

    public function getMediaUrl() {
        return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    }

    public function getConfigValue($value = '') {
        return $this->scopeConfig
                        ->getValue($value, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
    
    public function getBaseUrl() {
        return $this->_storeManager->getStore()->getBaseUrl();
    }
    
    /**
     * Send Mail
     *
     * @return $this
     *
     * @throws LocalizedException
     * @throws MailException
     */
    public function sendMail($vars) {
        $email = $this->getConfigValue('orderfeedback/settings/to_email');

        $this->inlineTranslation->suspend();
        $storeId = $this->getStoreId();

        /* email template */
        $template = $this->scopeConfig->getValue(
                self::EMAIL_TEMPLATE, \Magento\Store\Model\ScopeInterface::SCOPE_STORE, $storeId
        );

        // set from email
        $sender = $this->scopeConfig->getValue(
                'orderfeedback/settings/sender', \Magento\Store\Model\ScopeInterface::SCOPE_STORE, $this->getStoreId()
        );
        
        $transport = $this->transportBuilder->setTemplateIdentifier(
                        $template
                )->setTemplateOptions(
                        [
                            'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                            'store' => $this->getStoreId()
                        ]
                )->setTemplateVars(
                        $vars
                )->setFrom(
                        $sender
                )->addTo(
                        $email
                )->getTransport();

        try {
            $transport->sendMessage();
        } catch (\Exception $exception) {
            $this->logger->critical($exception->getMessage());
        }
        $this->inlineTranslation->resume();

        return $this;
    }

    /*
     * get Current store id
     */

    public function getStoreId() {
        return $this->_storeManager->getStore()->getId();
    }

    /*
     * get Current store Info
     */

    public function getStore() {
        return $this->_storeManager->getStore();
    }
}