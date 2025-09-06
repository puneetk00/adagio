<?php

namespace ET\Categorywidget\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper {

    protected $_storeManager;
    protected $_categoryCollectionFactory;
    protected $_category;

    public function __construct(
        \Magento\Framework\App\Helper\Context $context, 
        \Magento\Store\Model\StoreManagerInterface $storeManager, 
        \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $categoryCollectionFactory,
        \Magento\Catalog\Model\Category $category
    ) {
        $this->_storeManager = $storeManager;
        $this->_categoryCollectionFactory = $categoryCollectionFactory;
        $this->_category = $category;
        parent::__construct($context);
    }

    public function getCategoryCollection($isActive = true, $catIds = array()) {
        $blankArry = array();
        if (count($catIds) > 0) {
            $collection = $this->_categoryCollectionFactory->create();
            $collection->addAttributeToSelect('*');
            $collection->addFieldToFilter(
                    'entity_id', ['in' => $catIds]
            );

            // select only active categories
            if ($isActive) {
                $collection->addIsActiveFilter();
            }
            return $collection;
        } else {
            return $blankArry;
        }
    }

    public function getSubCategoryCollection($catId = 2, $subCatCount = 2) {
        $subCatArry = array();
        if ($catId != 0 && $catId != '') {
            $subca = $this->_category->load($catId);
            $subcats = $subca->getChildrenCategories();

            $i = 0;
            foreach ($subcats as $subcat) {
                if ($i == $subCatCount) {
                    break;
                }
                $_category = $this->_category->load($subcat->getId());
                $subCatArry[$i]['name'] = $_category->getName();
                $subCatArry[$i]['url'] = $_category->getUrl();
                $i++;
            }
        }
        return $subCatArry;
    }

}
