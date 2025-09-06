<?php

namespace ET\Categorywidget\Model\Config;

use Magento\Framework\Option\ArrayInterface;
use Magento\Catalog\Helper\Category;

class Categorylist implements ArrayInterface {

    protected $_categoryHelper;
    protected $categoryRepository;
    protected $categoryList;
    protected $_categoryCollectionFactory;

    public function __construct(
    \Magento\Catalog\Helper\Category $catalogCategory, \Magento\Catalog\Model\CategoryRepository $categoryRepository, \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $categoryCollectionFactory
    ) {
        $this->_categoryHelper = $catalogCategory;
        $this->categoryRepository = $categoryRepository;
        $this->_categoryCollectionFactory = $categoryCollectionFactory;
    }

    public function getStoreCategories() {
        $collection = $this->_categoryCollectionFactory->create();
        $collection->addAttributeToSelect('name')->addRootLevelFilter()->load();
        return $collection;
    }

    public function toOptionArray() {
        $arr = $this->toArray();
        $ret = [];

        foreach ($arr as $key => $value) {
            $ret[] = [
                'value' => $key,
                'label' => $value
            ];
        }

        return $ret;
    }

    public function toArray() {
        $categories = $this->getStoreCategories();
        $categoryList = $this->renderCategories($categories);
        return $categoryList;
    }

    public function renderCategories($_categories) {
        foreach ($_categories as $category) {
            $i = 0;
            $this->categoryList[$category->getEntityId()] = __($category->getName());   // Main categories
            $list = $this->renderSubCat($category, $i);
        }

        return $this->categoryList;
    }

    public function renderSubCat($cat, $j) {
        $categoryObj = $this->categoryRepository->get($cat->getId());

        $level = $categoryObj->getLevel();
        $arrow = str_repeat("---", $level - 1);
        $subcategories = $categoryObj->getChildrenCategories();

        foreach ($subcategories as $subcategory) {
            $this->categoryList[$subcategory->getEntityId()] = __($arrow . $subcategory->getName());

            if ($subcategory->hasChildren()) {

                $this->renderSubCat($subcategory, $j);
            }
        }
        return $this->categoryList;
    }

}
