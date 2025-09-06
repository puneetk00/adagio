<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace ET\Promotionbar\Api\Data;

/**
 * CMS block interface.
 * @api
 * @since 100.0.2
 */
interface PromotionInterface {
    /*     * #@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */

    const PROMO_ID = 'id';
    const PROMO_STYLE = 'promo_style';
    const PROMO_TEXT = 'promo_text';
    const BACKCOLOR = 'backcolor';
    const TEXTCOLOR = 'textcolor';
    const BTN_ENABLE = 'btn_enable';
    const BTN_STYLE = 'btn_style';
    const BTN_TEXT = 'btn_text';
    const BTN_URL = 'btn_url';
    const BTN_TARGET = 'btn_target';
    const BTN_BACKCOLOR = 'btn_backcolor';
    const BTN_TEXTCOLOR = 'btn_textcolor';
    const SUB_ENABLE = 'sub_enable';
    const SUB_TEXT_PLACEHOLDER = 'sub_text_placeholder';
    const SUB_BTN_TEXT = 'sub_btn_text';
    const SUB_BTN_BACKCOLOR = 'sub_btn_backcolor';
    const SUB_BTN_TEXTCOLOR = 'sub_btn_textcolor';
    const TIMER_ENABLE = 'timer_enable';
    const TIMER_ENDDATE = 'timer_enddate';
    const START_DATE = 'start_date';
    const END_DATE = 'end_date';
    const SORT_ORDER = 'sort_order';
    const STATUS = 'status';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get identifier
     *
     * @return string
     */
    public function getPromoStyle();

    /**
     * Get identifier
     *
     * @return string
     */
    public function getPromoText();

    /**
     * Get identifier
     *
     * @return string
     */
    public function getBackcolor();

    /**
     * Get identifier
     *
     * @return string
     */
    public function getTextcolor();

    /**
     * Get identifier
     *
     * @return string
     */
    public function getBtnEnable();

    /**
     * Get identifier
     *
     * @return string
     */
    public function getBtnStyle();

    /**
     * Get identifier
     *
     * @return string
     */
    public function getBtnText();

    /**
     * Get identifier
     *
     * @return string
     */
    public function getBtnUrl();

    /**
     * Get identifier
     *
     * @return string
     */
    public function getBtnTarget();

    /**
     * Get identifier
     *
     * @return string
     */
    public function getBtnBackcolor();

    /**
     * Get identifier
     *
     * @return string
     */
    public function getBtnTextcolor();

    /**
     * Get identifier
     *
     * @return string
     */
    public function getSubEnable();

    /**
     * Get identifier
     *
     * @return string
     */
    public function getSubTextPlaceholder();

    /**
     * Get identifier
     *
     * @return string
     */
    public function getSubBtnText();

    /**
     * Get identifier
     *
     * @return string
     */
    public function getSubBtnBackcolor();

    /**
     * Get identifier
     *
     * @return string
     */
    public function getSubBtnTextcolor();

    /**
     * Get identifier
     *
     * @return string
     */
    public function getTimerEnable();

    /**
     * Get identifier
     *
     * @return string
     */
    public function getTimerEnddate();

    /**
     * Get content
     *
     * @return string|null
     */
    public function getStartDate();

    /**
     * Get content
     *
     * @return string|null
     */
    public function getEndDate();

    /**
     * Get content
     *
     * @return string|null
     */
    public function getSortOrder();

    /**
     * Is active
     *
     * @return bool|null
     */
    public function getStatus();

    /**
     * Get creation time
     *
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Get creation time
     *
     * @return string|null
     */
    public function getUpdatedAt();

    /**
     * Set ID
     *
     * @param int $id
     * @return PromotionInterface
     */
    public function setId($id);

    /**
     * Set ID
     *
     * @param int $id
     * @return PromotionInterface
     */
    public function setPromoStyle($promoStyle);

    /**
     * Set ID
     *
     * @param int $id
     * @return PromotionInterface
     */
    public function setPromoText($promoText);

    /**
     * Set ID
     *
     * @param int $id
     * @return PromotionInterface
     */
    public function setBackcolor($backcolor);

    /**
     * Set ID
     *
     * @param int $id
     * @return PromotionInterface
     */
    public function setTextcolor($textcolor);

    /**
     * Set ID
     *
     * @param int $id
     * @return PromotionInterface
     */
    public function setBtnEnable($btnEnable);

    /**
     * Set ID
     *
     * @param int $id
     * @return PromotionInterface
     */
    public function setBtnStyle($btnStyle);

    /**
     * Set ID
     *
     * @param int $id
     * @return PromotionInterface
     */
    public function setBtnText($btnText);

    /**
     * Set ID
     *
     * @param int $id
     * @return PromotionInterface
     */
    public function setBtnUrl($btnUrl);

    /**
     * Set ID
     *
     * @param int $id
     * @return PromotionInterface
     */
    public function setBtnTarget($btnTarget);

    /**
     * Set ID
     *
     * @param int $id
     * @return PromotionInterface
     */
    public function setBtnBackcolor($btnBackcolor);

    /**
     * Set ID
     *
     * @param int $id
     * @return PromotionInterface
     */
    public function setBtnTextcolor($btnTextcolor);

    /**
     * Set ID
     *
     * @param int $id
     * @return PromotionInterface
     */
    public function setSubEnable($subEnable);

    /**
     * Set ID
     *
     * @param int $id
     * @return PromotionInterface
     */
    public function setSubTextPlaceholder($subTextPlaceholder);

    /**
     * Set ID
     *
     * @param int $id
     * @return PromotionInterface
     */
    public function setSubBtnText($subBtnText);

    /**
     * Set ID
     *
     * @param int $id
     * @return PromotionInterface
     */
    public function setSubBtnBackcolor($subBtnBackcolor);

    /**
     * Set ID
     *
     * @param int $id
     * @return PromotionInterface
     */
    public function setSubBtnTextcolor($subBtnTextcolor);

    /**
     * Set ID
     *
     * @param int $id
     * @return PromotionInterface
     */
    public function setTimerEnable($timerEnable);

    /**
     * Set ID
     *
     * @param int $id
     * @return PromotionInterface
     */
    public function setTimerEnddate($timerEnddate);

    /**
     * Set content
     *
     * @param string $content
     * @return PromotionInterface
     */
    public function setStartDate($startDate);

    /**
     * Set content
     *
     * @param string $content
     * @return PromotionInterface
     */
    public function setEndDate($endDate);

    /**
     * Set content
     *
     * @param string $content
     * @return PromotionInterface
     */
    public function setSortOrder($sortOrder);

    /**
     * Set is active
     *
     * @param bool|int $isActive
     * @return PromotionInterface
     */
    public function setStatus($status);

    /**
     * Set creation time
     *
     * @param string $creationTime
     * @return PromotionInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * Set creation time
     *
     * @param string $creationTime
     * @return PromotionInterface
     */
    public function setUpdatedAt($updatedAt);
}
