<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace ET\Promotionbar\Model;

use ET\Promotionbar\Api\Data\PromotionInterface;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

/**
 * CMS block model
 *
 * @method Promotion setStoreId(array $storeId)
 * @method array getStoreId()
 */
class Promotion extends AbstractModel implements PromotionInterface, IdentityInterface {

    /**
     * CMS block cache tag
     */
    const CACHE_TAG = 'cms_b';

    /*     * #@+
     * Promotion's statuses
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
    protected $_eventPrefix = 'et_promotionbar';

    /**
     * @return void
     */
    protected function _construct() {
        $this->_init(\ET\Promotionbar\Model\ResourceModel\Promotion::class);
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
        return $this->getData(self::PROMO_ID);
    }

    /**
     * Retrieve block id
     *
     * @return int
     */
    public function getPromoStyle() {
        return $this->getData(self::PROMO_STYLE);
    }

    /**
     * Retrieve block id
     *
     * @return int
     */
    public function getPromoText() {
        return $this->getData(self::PROMO_TEXT);
    }

    /**
     * Retrieve block id
     *
     * @return int
     */
    public function getBackcolor() {
        return $this->getData(self::BACKCOLOR);
    }

    /**
     * Retrieve block identifier
     *
     * @return string
     */
    public function getTextcolor() {
        return (string) $this->getData(self::TEXTCOLOR);
    }

    /**
     * Retrieve block title
     *
     * @return string
     */
    public function getBtnEnable() {
        return $this->getData(self::BTN_ENABLE);
    }

    /**
     * Retrieve block title
     *
     * @return string
     */
    public function getBtnStyle() {
        return $this->getData(self::BTN_STYLE);
    }

    /**
     * Retrieve block title
     *
     * @return string
     */
    public function getBtnText() {
        return $this->getData(self::BTN_TEXT);
    }

    /**
     * Retrieve block content
     *
     * @return string
     */
    public function getBtnUrl() {
        return $this->getData(self::BTN_URL);
    }

    /**
     * Retrieve block content
     *
     * @return string
     */
    public function getBtnTarget() {
        return $this->getData(self::BTN_TARGET);
    }

    /**
     * Retrieve block content
     *
     * @return string
     */
    public function getBtnBackcolor() {
        return $this->getData(self::BTN_BACKCOLOR);
    }

    /**
     * Retrieve block content
     *
     * @return string
     */
    public function getBtnTextcolor() {
        return $this->getData(self::BTN_TEXTCOLOR);
    }

    /**
     * Retrieve block content
     *
     * @return string
     */
    public function getSubEnable() {
        return $this->getData(self::SUB_ENABLE);
    }

    /**
     * Retrieve block content
     *
     * @return string
     */
    public function getSubTextPlaceholder() {
        return $this->getData(self::SUB_TEXT_PLACEHOLDER);
    }

    /**
     * Retrieve block content
     *
     * @return string
     */
    public function getSubBtnText() {
        return $this->getData(self::SUB_BTN_TEXT);
    }

    /**
     * Retrieve block content
     *
     * @return string
     */
    public function getSubBtnBackcolor() {
        return $this->getData(self::SUB_BTN_BACKCOLOR);
    }

    /**
     * Retrieve block content
     *
     * @return string
     */
    public function getSubBtnTextcolor() {
        return $this->getData(self::SUB_BTN_TEXTCOLOR);
    }

    /**
     * Retrieve block content
     *
     * @return string
     */
    public function getTimerEnable() {
        return $this->getData(self::TIMER_ENABLE);
    }

    /**
     * Retrieve block content
     *
     * @return string
     */
    public function getTimerEnddate() {
        return $this->getData(self::TIMER_ENDDATE);
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
     * @return PromotionInterface
     */
    public function setId($id) {
        return $this->setData(self::PROMO_ID, $id);
    }

    /**
     * Set ID
     *
     * @param int $id
     * @return PromotionInterface
     */
    public function setPromoStyle($promoStyle) {
        return $this->setData(self::PROMO_STYLE, $promoStyle);
    }

    /**
     * Set ID
     *
     * @param int $id
     * @return PromotionInterface
     */
    public function setPromoText($promoText) {
        return $this->setData(self::PROMO_TEXT, $promoText);
    }

    /**
     * Set ID
     *
     * @param int $id
     * @return PromotionInterface
     */
    public function setBackcolor($backcolor) {
        return $this->setData(self::BACKCOLOR, $backcolor);
    }

    /**
     * Set ID
     *
     * @param int $id
     * @return PromotionInterface
     */
    public function setTextcolor($textcolor) {
        return $this->setData(self::TEXTCOLOR, $textcolor);
    }

    /**
     * Set ID
     *
     * @param int $id
     * @return PromotionInterface
     */
    public function setBtnEnable($btnEnable) {
        return $this->setData(self::BTN_ENABLE, $btnEnable);
    }

    /**
     * Set ID
     *
     * @param int $id
     * @return PromotionInterface
     */
    public function setBtnStyle($btnStyle) {
        return $this->setData(self::BTN_STYLE, $btnStyle);
    }

    /**
     * Set ID
     *
     * @param int $id
     * @return PromotionInterface
     */
    public function setBtnText($btnText) {
        return $this->setData(self::BTN_TEXT, $btnText);
    }

    /**
     * Set ID
     *
     * @param int $id
     * @return PromotionInterface
     */
    public function setBtnUrl($btnUrl) {
        return $this->setData(self::BTN_URL, $btnUrl);
    }

    /**
     * Set ID
     *
     * @param int $id
     * @return PromotionInterface
     */
    public function setBtnTarget($btnTarget) {
        return $this->setData(self::BTN_TARGET, $btnTarget);
    }

    /**
     * Set ID
     *
     * @param int $id
     * @return PromotionInterface
     */
    public function setBtnBackcolor($btnBackcolor) {
        return $this->setData(self::BTN_BACKCOLOR, $btnBackcolor);
    }

    /**
     * Set ID
     *
     * @param int $id
     * @return PromotionInterface
     */
    public function setBtnTextcolor($btnTextcolor) {
        return $this->setData(self::BTN_TEXTCOLOR, $btnTextcolor);
    }

    /**
     * Set ID
     *
     * @param int $id
     * @return PromotionInterface
     */
    public function setSubEnable($subEnable) {
        return $this->setData(self::SUB_ENABLE, $subEnable);
    }

    /**
     * Set ID
     *
     * @param int $id
     * @return PromotionInterface
     */
    public function setSubTextPlaceholder($subTextPlaceholder) {
        return $this->setData(self::SUB_TEXT_PLACEHOLDER, $subTextPlaceholder);
    }

    /**
     * Set ID
     *
     * @param int $id
     * @return PromotionInterface
     */
    public function setSubBtnText($subBtnText) {
        return $this->setData(self::SUB_BTN_TEXT, $subBtnText);
    }

    /**
     * Set ID
     *
     * @param int $id
     * @return PromotionInterface
     */
    public function setSubBtnBackcolor($subBtnBackcolor) {
        return $this->setData(self::SUB_BTN_BACKCOLOR, $subBtnBackcolor);
    }

    /**
     * Set ID
     *
     * @param int $id
     * @return PromotionInterface
     */
    public function setSubBtnTextcolor($subBtnTextcolor) {
        return $this->setData(self::SUB_BTN_TEXTCOLOR, $subBtnTextcolor);
    }

    /**
     * Set ID
     *
     * @param int $id
     * @return PromotionInterface
     */
    public function setTimerEnable($timerEnable) {
        return $this->setData(self::TIMER_ENABLE, $timerEnable);
    }

    /**
     * Set ID
     *
     * @param int $id
     * @return PromotionInterface
     */
    public function setTimerEnddate($timerEnddate) {
        return $this->setData(self::TIMER_ENDDATE, $timerEnddate);
    }

    /**
     * Set content
     *
     * @param string $content
     * @return PromotionInterface
     */
    public function setStartDate($startDate) {
        return $this->setData(self::START_DATE, $startDate);
    }

    /**
     * Set content
     *
     * @param string $content
     * @return PromotionInterface
     */
    public function setEndDate($endDate) {
        return $this->setData(self::END_DATE, $endDate);
    }

    /**
     * Set content
     *
     * @param string $content
     * @return PromotionInterface
     */
    public function setSortOrder($sortOrder) {
        return $this->setData(self::SORT_ORDER, $sortOrder);
    }

    /**
     * Set creation time
     *
     * @param string $creationTime
     * @return PromotionInterface
     */
    public function setCreatedAt($createdAt) {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * Set creation time
     *
     * @param string $creationTime
     * @return PromotionInterface
     */
    public function setUpdatedAt($updatedAt) {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }

    /**
     * Set is active
     *
     * @param bool|int $isActive
     * @return PromotionInterface
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
