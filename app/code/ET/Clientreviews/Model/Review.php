<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace ET\Clientreviews\Model;

use ET\Clientreviews\Api\Data\ReviewInterface;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

/**
 * CMS block model
 *
 * @method Review setStoreId(array $storeId)
 * @method array getStoreId()
 */
class Review extends AbstractModel implements ReviewInterface, IdentityInterface {

    /**
     * CMS block cache tag
     */
    const CACHE_TAG = 'cms_b';

    /*     * #@+
     * Review's statuses
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
    protected $_eventPrefix = 'et_clientreviews';

    /**
     * @return void
     */
    protected function _construct() {
        $this->_init(\ET\Clientreviews\Model\ResourceModel\Review::class);
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
        return $this->getData(self::REVIEW_ID);
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
    public function getProfileImg() {
        return $this->getData(self::PROFILE_IMG);
    }

    /**
     * Retrieve block title
     *
     * @return string
     */
    public function getDesignation() {
        return $this->getData(self::DESIGNATION);
    }

    /**
     * Retrieve block title
     *
     * @return string
     */
    public function getLocation() {
        return $this->getData(self::LOCATION);
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
    public function getFacebookUrl() {
        return $this->getData(self::FACEBOOK_URL);
    }

    /**
     * Retrieve block content
     *
     * @return string
     */
    public function getTwitterUrl() {
        return $this->getData(self::TWITTER_URL);
    }

    /**
     * Retrieve block content
     *
     * @return string
     */
    public function getLinkedinUrl() {
        return $this->getData(self::LINKEDIN_URL);
    }

    /**
     * Retrieve block content
     *
     * @return string
     */
    public function getInstagramUrl() {
        return $this->getData(self::INSTAGRAM_URL);
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
     * @return ReviewInterface
     */
    public function setId($id) {
        return $this->setData(self::REVIEW_ID, $id);
    }

    /**
     * Set identifier
     *
     * @param string $identifier
     * @return ReviewInterface
     */
    public function setName($name) {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Set title
     *
     * @param string $title
     * @return ReviewInterface
     */
    public function setProfileImg($profileImg) {
        return $this->setData(self::PROFILE_IMG, $profileImg);
    }

    /**
     * Set title
     *
     * @param string $title
     * @return ReviewInterface
     */
    public function setDesignation($designation) {
        return $this->setData(self::DESIGNATION, $designation);
    }

    /**
     * Set title
     *
     * @param string $title
     * @return ReviewInterface
     */
    public function setLocation($location) {
        return $this->setData(self::LOCATION, $location);
    }

    /**
     * Set content
     *
     * @param string $content
     * @return ReviewInterface
     */
    public function setContent($content) {
        return $this->setData(self::CONTENT, $content);
    }

    /**
     * Set content
     *
     * @param string $content
     * @return ReviewInterface
     */
    public function setFacebookUrl($facebookUrl) {
        return $this->setData(self::FACEBOOK_URL, $facebookUrl);
    }

    /**
     * Set content
     *
     * @param string $content
     * @return ReviewInterface
     */
    public function setTwitterUrl($twitterUrl) {
        return $this->setData(self::TWITTER_URL, $twitterUrl);
    }

    /**
     * Set content
     *
     * @param string $content
     * @return ReviewInterface
     */
    public function setLinkedinUrl($linkedinUrl) {
        return $this->setData(self::LINKEDIN_URL, $linkedinUrl);
    }

    /**
     * Set content
     *
     * @param string $content
     * @return ReviewInterface
     */
    public function setInstagramUrl($instagramUrl) {
        return $this->setData(self::INSTAGRAM_URL, $instagramUrl);
    }

    /**
     * Set content
     *
     * @param string $content
     * @return ReviewInterface
     */
    public function setSortOrder($sortOrder) {
        return $this->setData(self::SORT_ORDER, $sortOrder);
    }

    /**
     * Set creation time
     *
     * @param string $creationTime
     * @return ReviewInterface
     */
    public function setCreatedAt($createdAt) {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * Set creation time
     *
     * @param string $creationTime
     * @return ReviewInterface
     */
    public function setUpdatedAt($updatedAt) {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }

    /**
     * Set is active
     *
     * @param bool|int $isActive
     * @return ReviewInterface
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
