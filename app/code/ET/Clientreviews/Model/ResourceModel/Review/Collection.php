<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace ET\Clientreviews\Model\ResourceModel\Review;

use ET\Clientreviews\Api\Data\ReviewInterface;
use ET\Clientreviews\Model\ResourceModel\AbstractCollection;

/**
 * CMS Review Collection
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
    protected $_eventPrefix = 'et_clientreviews_collection';

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
        $entityMetadata = $this->metadataPool->getMetadata(ReviewInterface::class);

        $this->performAfterLoad('et_clientreviews_store', $entityMetadata->getLinkField());

        return parent::_afterLoad();
    }

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct() {
        $this->_init(\ET\Clientreviews\Model\Review::class, \ET\Clientreviews\Model\ResourceModel\Review::class);
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
        $entityMetadata = $this->metadataPool->getMetadata(ReviewInterface::class);
        $this->joinStoreRelationTable('et_clientreviews_store', $entityMetadata->getLinkField());
    }

}
