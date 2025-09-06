<?php

namespace ET\Promotionbar\Model\ResourceModel\Promotion\Relation\Store;

use ET\Promotionbar\Model\ResourceModel\Promotion;
use Magento\Framework\EntityManager\Operation\ExtensionInterface;

/**
 * Class ReadHandler
 */
class ReadHandler implements ExtensionInterface {

    /**
     * @var Promotion
     */
    protected $resourcePromotion;

    /**
     * @param Promotion $resourcePromotion
     */
    public function __construct(
    Promotion $resourcePromotion
    ) {
        $this->resourcePromotion = $resourcePromotion;
    }

    /**
     * @param object $entity
     * @param array $arguments
     * @return object
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function execute($entity, $arguments = []) {
        if ($entity->getId()) {
            $stores = $this->resourcePromotion->lookupStoreIds((int) $entity->getId());
            $entity->setData('store_id', $stores);
            $entity->setData('stores', $stores);
        }
        return $entity;
    }

}
