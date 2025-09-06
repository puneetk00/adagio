<?php

namespace ET\Theme\Model\Import;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\DataObject;
use Magento\Store\Model\ScopeInterface;
use Magento\Cms\Model\ResourceModel\Block\CollectionFactory as BlockCollectionFactory;
use Magento\Cms\Model\BlockFactory as BlockFactory;
use Magento\Cms\Model\ResourceModel\Block as BlockResourceBlock;
use Magento\Cms\Model\ResourceModel\Page\CollectionFactory as PageCollectionFactory;
use Magento\Cms\Model\PageFactory as PageFactory;
use Magento\Cms\Model\ResourceModel\Page as PageResourceBlock;

class Slider {

    /**
     * @var ScopeConfigInterface
     */
    protected $_scopeConfig;
    protected $_storeManager;
    private $_importPath;
    protected $_parser;

    public function __construct(
        ScopeConfigInterface $scopeConfig, 
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->_scopeConfig = $scopeConfig;
        $this->_storeManager = $storeManager;

        $this->_importPath = BP . '/app/code/ET/Theme/etc/import/';
        $this->_parser = new \Magento\Framework\Xml\Parser();
    }

    public function importSlider($type, $demo_version) {
        // Default response
        $gatewayResponse = new DataObject([
            'is_valid' => false,
            'import_path' => '',
            'request_success' => false,
            'request_message' => __('Error during Import Slider Sample Datas.'),
        ]);

        try {
            $xmlPath = $this->_importPath . $type . '.xml';
            $demoCMSxmlPath = $this->_importPath . 'sliders.xml';

            $overwrite = false;

            if (!is_readable($xmlPath) || !is_readable($demoCMSxmlPath)) {
                throw new \Exception(
                __("Can't get the data file for import cms blocks/pages: " . $xmlPath)
                );
            }
            $data = $this->_parser->load($xmlPath)->xmlToArray();

            foreach ($data['root'][$type]['banner_item'] as $bannerKey => $bannerVal) {
                $demo = $bannerVal['demo'];
                if ($demo == $demo_version) {
                    $bannerName = $bannerVal['name'];
                    $bannerImg = $bannerVal['img'];
                    $bannerLink = $bannerVal['link'];
                    $bannerTarget = $bannerVal['target'];
                    $bannerContent = $bannerVal['content'];
                    $bannerContentPosition = $bannerVal['content_position'];
                    $bannerDisablemobile = $bannerVal['disablemobile'];
                    $bannerStartDate = $bannerVal['start_date'];
                    $bannerEndDate = $bannerVal['end_date'];
                    $bannerStoreId = $this->_storeManager->getStore()->getId();
                    $bannerSortOrder = $bannerVal['sort_order'];
                    $bannerStatus = $bannerVal['status'];

                    $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
                    $bannerCollectionObject = $objectManager->get('ET\Bannerslider\Model\BannerFactory');
                    $bannerCollection = $bannerCollectionObject->create()
                            ->setName($bannerName)
                            ->setImg($bannerImg)
                            ->setLink($bannerLink)
                            ->setTarget($bannerTarget)
                            ->setContent($bannerContent)
                            ->setContentPosition($bannerContentPosition)
                            ->setDisablemobile($bannerDisablemobile)
                            ->setStartDate($bannerStartDate)
                            ->setEndDate($bannerEndDate)
                            ->setStoreId($bannerStoreId)
                            ->setSortOrder($bannerSortOrder)
                            ->setStatus($bannerStatus)
                            ->save();
                }
            }

            $message = "Slider data has been imported.";
            $gatewayResponse->setIsValid(true);
            $gatewayResponse->setRequestSuccess(true);
            $gatewayResponse->setRequestMessage(__($message));
        } catch (\Exception $exception) {
            $gatewayResponse->setIsValid(false);
            $gatewayResponse->setRequestMessage($exception->getMessage());
        }

        return $gatewayResponse;
    }

}
