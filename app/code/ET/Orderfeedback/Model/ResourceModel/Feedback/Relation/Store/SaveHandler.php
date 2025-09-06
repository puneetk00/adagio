<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace ET\Orderfeedback\Model\ResourceModel\Feedback\Relation\Store;

use Magento\Framework\EntityManager\Operation\ExtensionInterface;
use ET\Orderfeedback\Api\Data\FeedbackInterface;
use ET\Orderfeedback\Model\ResourceModel\Feedback;
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
     * @var Feedback
     */
    protected $resourceFeedback;

    /**
     * @param MetadataPool $metadataPool
     * @param Feedback $resourceFeedback
     */
    public function __construct(
    MetadataPool $metadataPool, Feedback $resourceFeedback
    ) {
        $this->metadataPool = $metadataPool;
        $this->resourceFeedback = $resourceFeedback;
    }

    /**
     * @param object $entity
     * @param array $arguments
     * @return object
     * @throws \Exception
     */
    public function execute($entity, $arguments = []) {
        $entityMetadata = $this->metadataPool->getMetadata(FeedbackInterface::class);
        $linkField = $entityMetadata->getLinkField();

        $connection = $entityMetadata->getEntityConnection();

        $oldStores = $this->resourceFeedback->lookupStoreIds((int) $entity->getId());
        $newStores = (array) $entity->getStores();

        $table = $this->resourceFeedback->getTable('et_orderfeedback_store');

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
