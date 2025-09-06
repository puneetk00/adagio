<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace ET\Bannerslider\Model;

use ET\Bannerslider\Api\Data\BannerInterface;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

/**
 * CMS block model
 *
 * @method Banner setStoreId(array $storeId)
 * @method array getStoreId()
 */
class Banner extends AbstractModel implements BannerInterface, IdentityInterface {

    /**
     * CMS block cache tag
     */
    const CACHE_TAG = 'cms_b';

    /*     * #@+
     * Banner's statuses
     */
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    /*     * #@- */

    /*     * #@- */

    protected $_cacheTag = self::CACHE_TAG;

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'et_bannerslider';

    /**
     * @return void
     */
    protected function _construct() {
        $this->_init(\ET\Bannerslider\Model\ResourceModel\Banner::class);
    }

    /**
     * Prevent blocks recursion
     *
     * @return AbstractModel
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function beforeSave() {
        if ($this->hasDataChanges()) {
            $this->setUpdateTime(null);
        }

        $needle = 'id="' . $this->getId() . '"';
        if (false == strstr($this->getContent(), $needle)) {
            return parent::beforeSave();
        }
        throw new \Magento\Framework\Exception\LocalizedException(
        __('Make sure that static block content does not reference the block itself.')
        );
    }

    /**
     * Get identities
     *
     * @return array
     */
    public function getIdentities() {
        return [self::CACHE_TAG . '_' . $this->getId(), self::CACHE_TAG . '_' . $this->getIdentifier()];
    }

    /**
     * Retrieve block id
     *
     * @return int
     */
    public function getId() {
        return $this->getData(self::BANNER_ID);
    }

    /**
     * Retrieve block identifier
     *
     * @return string
     */
    public function getName() {
        return (string) $this->getData(self::NAME);
    }

    /**
     * Retrieve block title
     *
     * @return string
     */
    public function getImg() {
        return $this->getData(self::IMAGE);
    }

    /**
     * Retrieve block title
     *
     * @return string
     */
    public function getLink() {
        return $this->getData(self::LINK);
    }

    /**
     * Retrieve block title
     *
     * @return string
     */
    public function getTarget() {
        return $this->getData(self::TARGET);
    }

    /**
     * Retrieve block content
     *
     * @return string
     */
    public function getContent() {
        return $this->getData(self::CONTENT);
    }

    /**
     * Retrieve block content
     *
     * @return string
     */
    public function getContentPosition() {
        return $this->getData(self::CONTENT_POSITION);
    }

    /**
     * Retrieve block content
     *
     * @return string
     */
    public function getDisableMobile() {
        return $this->getData(self::DISABLE_MOBILE);
    }

    /**
     * Retrieve block content
     *
     * @return string
     */
    public function getStartDate() {
        return $this->getData(self::START_DATE);
    }

    /**
     * Retrieve block content
     *
     * @return string
     */
    public function getEndDate() {
        return $this->getData(self::END_DATE);
    }

    /**
     * Retrieve block content
     *
     * @return string
     */
    public function getSortOrder() {
        return $this->getData(self::SORT_ORDER);
    }

    /**
     * Retrieve block creation time
     *
     * @return string
     */
    public function getCreatedAt() {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * Retrieve block creation time
     *
     * @return string
     */
    public function getUpdatedAt() {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * Is active
     *
     * @return bool
     */
    public function getStatus() {
        return (bool) $this->getData(self::STATUS);
    }

    /**
     * Set ID
     *
     * @param int $id
     * @return BannerInterface
     */
    public function setId($id) {
        return $this->setData(self::BANNER_ID, $id);
    }

    /**
     * Set identifier
     *
     * @param string $identifier
     * @return BannerInterface
     */
    public function setName($name) {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Set title
     *
     * @param string $title
     * @return BannerInterface
     */
    public function setImg($img) {
        return $this->setData(self::IMAGE, $img);
    }

    /**
     * Set title
     *
     * @param string $title
     * @return BannerInterface
     */
    public function setLink($link) {
        return $this->setData(self::LINK, $link);
    }

    /**
     * Set title
     *
     * @param string $title
     * @return BannerInterface
     */
    public function setTarget($target) {
        return $this->setData(self::TARGET, $target);
    }

    /**
     * Set content
     *
     * @param string $content
     * @return BannerInterface
     */
    public function setContent($content) {
        return $this->setData(self::CONTENT, $content);
    }

    /**
     * Set content
     *
     * @param string $content
     * @return BannerInterface
     */
    public function setContentPosition($contentPosition) {
        return $this->setData(self::CONTENT_POSITION, $contentPosition);
    }

    /**
     * Set content
     *
     * @param string $content
     * @return BannerInterface
     */
    public function setDisableMobile($disableMobile) {
        return $this->setData(self::DISABLE_MOBILE, $disableMobile);
    }

    /**
     * Set content
     *
     * @param string $content
     * @return BannerInterface
     */
    public function setStartDate($startDate) {
        return $this->setData(self::START_DATE, $startDate);
    }

    /**
     * Set content
     *
     * @param string $content
     * @return BannerInterface
     */
    public function setEndDate($endDate) {
        return $this->setData(self::END_DATE, $endDate);
    }

    /**
     * Set content
     *
     * @param string $content
     * @return BannerInterface
     */
    public function setSortOrder($sortOrder) {
        return $this->setData(self::SORT_ORDER, $sortOrder);
    }

    /**
     * Set creation time
     *
     * @param string $creationTime
     * @return BannerInterface
     */
    public function setCreatedAt($createdAt) {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * Set creation time
     *
     * @param string $creationTime
     * @return BannerInterface
     */
    public function setUpdatedAt($updatedAt) {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }

    /**
     * Set is active
     *
     * @param bool|int $isActive
     * @return BannerInterface
     */
    public function setStatus($status) {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * Receive page store ids
     *
     * @return int[]
     */
    public function getStores() {
        return $this->hasData('stores') ? $this->getData('stores') : $this->getData('store_id');
    }

    /**
     * Prepare block's statuses.
     *
     * @return array
     */
    public function getAvailableStatuses() {
        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }

}
