<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace ET\Clientreviews\Model\ResourceModel\Review\Relation\Store;

use ET\Clientreviews\Model\ResourceModel\Review;
use Magento\Framework\EntityManager\Operation\ExtensionInterface;

/**
 * Class ReadHandler
 */
class ReadHandler implements ExtensionInterface {

    /**
     * @var Review
     */
    protected $resourceReview;

    /**
     * @param Review $resourceReview
     */
    public function __construct(
    Review $resourceReview
    ) {
        $this->resourceReview = $resourceReview;
    }

    /**
     * @param object $entity
     * @param array $arguments
     * @return object
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function execute($entity, $arguments = []) {
        if ($entity->getId()) {
            $stores = $this->resourceReview->lookupStoreIds((int) $entity->getId());
            $entity->setData('store_id', $stores);
            $entity->setData('stores', $stores);
        }
        return $entity;
    }

}
