<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace ET\Clientreviews\Api;

/**
 * CMS block CRUD interface.
 * @api
 * @since 100.0.2
 */
interface ReviewRepositoryInterface {

    /**
     * Save block.
     *
     * @param \ET\Clientreviews\Api\Data\ReviewInterface $block
     * @return \ET\Clientreviews\Api\Data\ReviewInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(Data\ReviewInterface $block);

    /**
     * Retrieve block.
     *
     * @param int $blockId
     * @return \ET\Clientreviews\Api\Data\ReviewInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($blockId);

    /**
     * Retrieve blocks matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \ET\Clientreviews\Api\Data\ReviewSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * Delete block.
     *
     * @param \ET\Clientreviews\Api\Data\ReviewInterface $block
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(Data\ReviewInterface $block);

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
