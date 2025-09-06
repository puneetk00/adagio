<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace ET\Bannerslider\Api\Data;

/**
 * CMS block interface.
 * @api
 * @since 100.0.2
 */
interface BannerInterface {
    /*     * #@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */

    const BANNER_ID = 'id';
    const NAME = 'name';
    const IMAGE = 'img';
    const LINK = 'link';
    const TARGET = 'target';
    const CONTENT = 'content';
    const CONTENT_POSITION = 'content_position';
    const DISABLE_MOBILE = 'disable_mobile';
    const START_DATE = 'start_date';
    const END_DATE = 'end_date';
    const SORT_ORDER = 'sort_order';
    const STATUS = 'status';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    /*     * #@- */

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
    public function getName();

    /**
     * Get title
     *
     * @return string|null
     */
    public function getImg();

    /**
     * Get content
     *
     * @return string|null
     */
    public function getLink();

    /**
     * Get content
     *
     * @return string|null
     */
    public function getTarget();

    /**
     * Get content
     *
     * @return string|null
     */
    public function getContent();

    /**
     * Get content
     *
     * @return string|null
     */
    public function getContentPosition();

    /**
     * Get content
     *
     * @return string|null
     */
    public function getDisableMObile();

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
     * @return BannerInterface
     */
    public function setId($id);

    /**
     * Set identifier
     *
     * @param string $identifier
     * @return BannerInterface
     */
    public function setName($name);

    /**
     * Set title
     *
     * @param string $title
     * @return BannerInterface
     */
    public function setImg($img);

    /**
     * Set content
     *
     * @param string $content
     * @return BannerInterface
     */
    public function setLink($link);

    /**
     * Set content
     *
     * @param string $content
     * @return BannerInterface
     */
    public function setTarget($target);

    /**
     * Set content
     *
     * @param string $content
     * @return BannerInterface
     */
    public function setContent($content);

    /**
     * Set content
     *
     * @param string $content
     * @return BannerInterface
     */
    public function setContentPosition($contentPosition);

    /**
     * Set content
     *
     * @param string $content
     * @return BannerInterface
     */
    public function setDisableMobile($disableMobile);

    /**
     * Set content
     *
     * @param string $content
     * @return BannerInterface
     */
    public function setStartDate($startDate);

    /**
     * Set content
     *
     * @param string $content
     * @return BannerInterface
     */
    public function setEndDate($endDate);

    /**
     * Set content
     *
     * @param string $content
     * @return BannerInterface
     */
    public function setSortOrder($sortOrder);

    /**
     * Set is active
     *
     * @param bool|int $isActive
     * @return BannerInterface
     */
    public function setStatus($status);

    /**
     * Set creation time
     *
     * @param string $creationTime
     * @return BannerInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * Set creation time
     *
     * @param string $creationTime
     * @return BannerInterface
     */
    public function setUpdatedAt($updatedAt);
}
