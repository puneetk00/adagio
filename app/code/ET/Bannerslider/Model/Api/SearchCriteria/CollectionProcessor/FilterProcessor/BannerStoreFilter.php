<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace ET\Bannerslider\Model\Api\SearchCriteria\CollectionProcessor\FilterProcessor;

use Magento\Framework\Api\Filter;
use Magento\Framework\Api\SearchCriteria\CollectionProcessor\FilterProcessor\CustomFilterInterface;
use Magento\Framework\Data\Collection\AbstractDb;

class BannerStoreFilter implements CustomFilterInterface
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
        /** @var \ET\Bannerslider\Model\ResourceModel\Banner\Collection $collection */
        $collection->addStoreFilter($filter->getValue(), false);

        return true;
    }
}