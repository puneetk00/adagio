<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types = 1);

namespace ET\Promotionbar\Ui\Component\Promotion;

use ET\Promotionbar\Ui\Component\AddFilterInterface;
use Magento\Framework\Api\Filter;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;

/**
 * Adds fulltext filter for CMS Page title attribute.
 */
class FulltextFilter implements AddFilterInterface {

    /**
     * @var FilterBuilder
     */
    private $filterBuilder;

    /**
     * @param FilterBuilder $filterBuilder
     */
    public function __construct(FilterBuilder $filterBuilder) {
        $this->filterBuilder = $filterBuilder;
    }

    /**
     * @inheritdoc
     */
    public function addFilter(SearchCriteriaBuilder $searchCriteriaBuilder, Filter $filter) {
        $titleFilter = $this->filterBuilder->setField('promo_text')
                ->setValue(sprintf('%%%s%%', $filter->getValue()))
                ->setConditionType('like')
                ->create();
        $searchCriteriaBuilder->addFilter($titleFilter);
    }

}
