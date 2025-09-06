<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace ET\Clientreviews\Model\ResourceModel\Review\Relation\Store;

use Magento\Framework\EntityManager\Operation\ExtensionInterface;
use ET\Clientreviews\Api\Data\ReviewInterface;
use ET\Clientreviews\Model\ResourceModel\Review;
use Magento\Framework\EntityManager\MetadataPool;

/**
 * Class SaveHandler
 */
class SaveHandler implements ExtensionInterface {

    /**
     * @var MetadataPool
     */
    protected $metadataPool;

    /**
     * @var Review
     */
    protected $resourceReview;

    /**
     * @param MetadataPool $metadataPool
     * @param Review $resourceReview
     */
    public function __construct(
    MetadataPool $metadataPool, Review $resourceReview
    ) {
        $this->metadataPool = $metadataPool;
        $this->resourceReview = $resourceReview;
    }

    /**
     * @param object $entity
     * @param array $arguments
     * @return object
     * @throws \Exception
     */
    public function execute($entity, $arguments = []) {
        $entityMetadata = $this->metadataPool->getMetadata(ReviewInterface::class);
        $linkField = $entityMetadata->getLinkField();

        $connection = $entityMetadata->getEntityConnection();

        $oldStores = $this->resourceReview->lookupStoreIds((int) $entity->getId());
        $newStores = (array) $entity->getStores();

        $table = $this->resourceReview->getTable('et_clientreviews_store');

        $delete = array_diff($oldStores, $newStores);
        if ($delete) {
            $where = [
                $linkField . ' = ?' => (int) $entity->getData($linkField),
                'store_id IN (?)' => $delete,
            ];
            $connection->delete($table, $where);
        }

        $insert = array_diff($newStores, $oldStores);
        if ($insert) {
            $data = [];
            foreach ($insert as $storeId) {
                $data[] = [
                    $linkField => (int) $entity->getData($linkField),
                    'store_id' => (int) $storeId,
                ];
            }
            $connection->insertMultiple($table, $data);
        }

        return $entity;
    }

}
