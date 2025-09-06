<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace ET\Orderfeedback\Api;

/**
 * CMS block CRUD interface.
 * @api
 * @since 100.0.2
 */
interface FeedbackRepositoryInterface {

    /**
     * Save block.
     *
     * @param \ET\Orderfeedback\Api\Data\FeedbackInterface $block
     * @return \ET\Orderfeedback\Api\Data\FeedbackInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(Data\FeedbackInterface $block);

    /**
     * Retrieve block.
     *
     * @param int $blockId
     * @return \ET\Orderfeedback\Api\Data\FeedbackInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($blockId);

    /**
     * Retrieve blocks matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \ET\Orderfeedback\Api\Data\FeedbackSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * Delete block.
     *
     * @param \ET\Orderfeedback\Api\Data\FeedbackInterface $block
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(Data\FeedbackInterface $block);

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
