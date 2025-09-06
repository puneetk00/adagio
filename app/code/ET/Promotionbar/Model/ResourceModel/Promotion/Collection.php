<?php

namespace ET\Promotionbar\Model\ResourceModel\Promotion;

use ET\Promotionbar\Api\Data\PromotionInterface;
use ET\Promotionbar\Model\ResourceModel\AbstractCollection;

/**
 * CMS Promotion Collection
 */
class Collection extends AbstractCollection {

    /**
     * @var string
     */
    protected $_idFieldName = 'id';

    /**
     * Event prefix
     *
     * @var string
     */
    protected $_eventPrefix = 'et_promotionbar_collection';

    /**
     * Event object
     *
     * @var string
     */
    protected $_eventObject = 'block_collection';

    /**
     * Perform operations after collection load
     *
     * @return $this
     */
    protected function _afterLoad() {
        $entityMetadata = $this->metadataPool->getMetadata(PromotionInterface::class);

        $this->performAfterLoad('et_promotionbar_store', $entityMetadata->getLinkField());

        return parent::_afterLoad();
    }

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct() {
        $this->_init(\ET\Promotionbar\Model\Promotion::class, \ET\Promotionbar\Model\ResourceModel\Promotion::class);
        $this->_map['fields']['store'] = 'store_table.store_id';
        $this->_map['fields']['id'] = 'main_table.id';
    }

    /**
     * Returns pairs id - title
     *
     * @return array
     */
    public function toOptionArray() {
        return $this->_toOptionArray('id', 'title');
    }

    /**
     * Add filter by store
     *
     * @param int|array|\Magento\Store\Model\Store $store
     * @param bool $withAdmin
     * @return $this
     */
    public function addStoreFilter($store, $withAdmin = true) {
        $this->performAddStoreFilter($store, $withAdmin);

        return $this;
    }

    /**
     * Join store relation table if there is store filter
     *
     * @return void
     */
    protected function _renderFiltersBefore() {
        $entityMetadata = $this->metadataPool->getMetadata(PromotionInterface::class);
        $this->joinStoreRelationTable('et_promotionbar_store', $entityMetadata->getLinkField());
    }

}
