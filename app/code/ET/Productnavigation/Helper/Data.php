<?php

namespace ET\Productnavigation\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper {

    protected $_storeManager;
    protected $_productFactory;

    public function __construct(
    \Magento\Framework\App\Helper\Context $context, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Catalog\Model\ProductFactory $productFactory
    ) {
        $this->_storeManager = $storeManager;
        $this->_productFactory = $productFactory;

        parent::__construct($context);
    }

    public function getCategoryProductIds($current_category) {
        $category_products = $current_category->getProductCollection()
                ->addAttributeToSelect('*')
                ->addAttributeToFilter('is_saleable', 1, 'left')
                ->addAttributeToSort('position', 'asc');
        $cat_prod_ids = $category_products->getAllIds();

        return $cat_prod_ids;
    }

    public function getPrevProduct($product) {
        $current_category = $product->getCategory();
        if (!$current_category) {
            foreach ($product->getCategoryCollection() as $parent_cat) {
                $current_category = $parent_cat;
            }
        }
        if (!$current_category)
            return false;
        $cat_prod_ids = $this->getCategoryProductIds($current_category);
        $_pos = array_search($product->getId(), $cat_prod_ids);
        if (isset($cat_prod_ids[$_pos - 1])) {
            $prev_product = $this->_productFactory->create()->load($cat_prod_ids[$_pos - 1]);
            return $prev_product;
        }
        return false;
    }

    public function getNextProduct($product) {
        $current_category = $product->getCategory();
        if (!$current_category) {
            foreach ($product->getCategoryCollection() as $parent_cat) {
                $current_category = $parent_cat;
            }
        }
        if (!$current_category)
            return false;
        $cat_prod_ids = $this->getCategoryProductIds($current_category);
        $_pos = array_search($product->getId(), $cat_prod_ids);
        if (isset($cat_prod_ids[$_pos + 1])) {
            $next_product = $this->_productFactory->create()->load($cat_prod_ids[$_pos + 1]);
            return $next_product;
        }
        return false;
    }

}
