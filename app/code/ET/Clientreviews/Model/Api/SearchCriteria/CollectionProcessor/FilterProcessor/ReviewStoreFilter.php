<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace ET\Clientreviews\Model\Api\SearchCriteria\CollectionProcessor\FilterProcessor;

use Magento\Framework\Api\Filter;
use Magento\Framework\Api\SearchCriteria\CollectionProcessor\FilterProcessor\CustomFilterInterface;
use Magento\Framework\Data\Collection\AbstractDb;

class ReviewStoreFilter implements CustomFilterInterface
{
    /**
     * Apply custom store filter to collection
     *
     * @param Filter $filter
     * @param AbstractDb $collection
     * @return bool
     */
    public function apply(Filter $filter, AbstractDb $collection)
    {
        /** @var \ET\Clientreviews\Model\ResourceModel\Review\Collection $collection */
        $collection->addStoreFilter($filter->getValue(), false);

        return true;
    }
}