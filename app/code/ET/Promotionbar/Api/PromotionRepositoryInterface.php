<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace ET\Promotionbar\Api;

/**
 * CMS block CRUD interface.
 * @api
 * @since 100.0.2
 */
interface PromotionRepositoryInterface {

    /**
     * Save block.
     *
     * @param \ET\Promotionbar\Api\Data\PromotionInterface $block
     * @return \ET\Promotionbar\Api\Data\PromotionInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(Data\PromotionInterface $block);

    /**
     * Retrieve block.
     *
     * @param int $blockId
     * @return \ET\Promotionbar\Api\Data\PromotionInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($blockId);

    /**
     * Retrieve blocks matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \ET\Promotionbar\Api\Data\PromotionSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * Delete block.
     *
     * @param \ET\Promotionbar\Api\Data\PromotionInterface $block
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(Data\PromotionInterface $block);

    /**
     * Delete block by ID.
     *
     * @param int $blockId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($blockId);
}
