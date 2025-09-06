<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace ET\Bannerslider\Api;

/**
 * CMS block CRUD interface.
 * @api
 * @since 100.0.2
 */
interface BannerRepositoryInterface {

    /**
     * Save block.
     *
     * @param \ET\Bannerslider\Api\Data\BannerInterface $block
     * @return \ET\Bannerslider\Api\Data\BannerInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(Data\BannerInterface $block);

    /**
     * Retrieve block.
     *
     * @param int $blockId
     * @return \ET\Bannerslider\Api\Data\BannerInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($blockId);

    /**
     * Retrieve blocks matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \ET\Bannerslider\Api\Data\BannerSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * Delete block.
     *
     * @param \ET\Bannerslider\Api\Data\BannerInterface $block
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(Data\BannerInterface $block);

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
