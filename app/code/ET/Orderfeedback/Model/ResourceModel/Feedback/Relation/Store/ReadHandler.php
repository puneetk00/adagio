<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace ET\Orderfeedback\Model\ResourceModel\Feedback\Relation\Store;

use ET\Orderfeedback\Model\ResourceModel\Feedback;
use Magento\Framework\EntityManager\Operation\ExtensionInterface;

/**
 * Class ReadHandler
 */
class ReadHandler implements ExtensionInterface {

    /**
     * @var Feedback
     */
    protected $resourceFeedback;

    /**
     * @param Feedback $resourceFeedback
     */
    public function __construct(
    Feedback $resourceFeedback
    ) {
        $this->resourceFeedback = $resourceFeedback;
    }

    /**
     * @param object $entity
     * @param array $arguments
     * @return object
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function execute($entity, $arguments = []) {
        if ($entity->getId()) {
            $stores = $this->resourceFeedback->lookupStoreIds((int) $entity->getId());
            $entity->setData('store_id', $stores);
            $entity->setData('stores', $stores);
        }
        return $entity;
    }

}
