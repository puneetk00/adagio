<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace ET\Orderfeedback\Model;

use ET\Orderfeedback\Api\Data\FeedbackInterface;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

/**
 * CMS block model
 *
 * @method Feedback setStoreId(array $storeId)
 * @method array getStoreId()
 */
class Feedback extends AbstractModel implements FeedbackInterface, IdentityInterface {

    /**
     * CMS block cache tag
     */
    const CACHE_TAG = 'cms_b';

    /*     * #@+
     * Feedback's statuses
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
    protected $_eventPrefix = 'et_orderfeedback';

    /**
     * @return void
     */
    protected function _construct() {
        $this->_init(\ET\Orderfeedback\Model\ResourceModel\Feedback::class);
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
        return $this->getData(self::FEEDBACK_ID);
    }

    /**
     * Retrieve block identifier
     *
     * @return string
     */
    public function getOrderId() {
        return (string) $this->getData(self::ORDER_ID);
    }

    /**
     * Retrieve block title
     *
     * @return string
     */
    public function getCustomerId() {
        return $this->getData(self::CUSTOMER_ID);
    }

    /**
     * Retrieve block title
     *
     * @return string
     */
    public function getCustomerName() {
        return $this->getData(self::CUSTOMER_NAME);
    }

    /**
     * Retrieve block title
     *
     * @return string
     */
    public function getCustomerEmail() {
        return $this->getData(self::CUSTOMER_EMAIL);
    }

    /**
     * Retrieve block title
     *
     * @return string
     */
    public function getRating() {
        return $this->getData(self::RATING);
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
     * Retrieve block creation time
     *
     * @return string
     */
    public function getCreatedAt() {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * Set ID
     *
     * @param int $id
     * @return FeedbackInterface
     */
    public function setId($id) {
        return $this->setData(self::FEEDBACK_ID, $id);
    }

    /**
     * Set identifier
     *
     * @param string $identifier
     * @return FeedbackInterface
     */
    public function setOrderId($orderId) {
        return $this->setData(self::ORDER_ID, $orderId);
    }

    /**
     * Set title
     *
     * @param string $title
     * @return FeedbackInterface
     */
    public function setCustomerId($customerId) {
        return $this->setData(self::CUSTOMER_ID, $customerId);
    }

    /**
     * Set title
     *
     * @param string $title
     * @return FeedbackInterface
     */
    public function setCustomerName($customerName) {
        return $this->setData(self::CUSTOMER_NAME, $customerName);
    }

    /**
     * Set title
     *
     * @param string $title
     * @return FeedbackInterface
     */
    public function setCustomerEmail($customerEmail) {
        return $this->setData(self::CUSTOMER_EMAIL, $customerEmail);
    }

    /**
     * Set title
     *
     * @param string $title
     * @return FeedbackInterface
     */
    public function setRating($rating) {
        return $this->setData(self::RATING, $rating);
    }

    /**
     * Set content
     *
     * @param string $content
     * @return FeedbackInterface
     */
    public function setContent($content) {
        return $this->setData(self::CONTENT, $content);
    }

    /**
     * Set creation time
     *
     * @param string $creationTime
     * @return FeedbackInterface
     */
    public function setCreatedAt($createdAt) {
        return $this->setData(self::CREATED_AT, $createdAt);
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
