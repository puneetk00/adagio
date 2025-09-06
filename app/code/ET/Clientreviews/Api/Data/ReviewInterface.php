<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace ET\Clientreviews\Api\Data;

/**
 * CMS block interface.
 * @api
 * @since 100.0.2
 */
interface ReviewInterface {
    /*     * #@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */

    const REVIEW_ID = 'id';
    const NAME = 'name';
    const PROFILE_IMG = 'profile_img';
    const DESIGNATION = 'designation';
    const LOCATION = 'location';
    const CONTENT = 'content';
    const FACEBOOK_URL = 'facebook_url';
    const TWITTER_URL = 'twitter_url';
    const LINKEDIN_URL = 'linkedin_url';
    const INSTAGRAM_URL = 'instagram_url';
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
    public function getName();

    /**
     * Get title
     *
     * @return string|null
     */
    public function getProfileImg();

    /**
     * Get content
     *
     * @return string|null
     */
    public function getDesignation();

    /**
     * Get content
     *
     * @return string|null
     */
    public function getLocation();

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
    public function getFacebookUrl();

    /**
     * Get content
     *
     * @return string|null
     */
    public function getTwitterUrl();

    /**
     * Get content
     *
     * @return string|null
     */
    public function getLinkedinUrl();

    /**
     * Get content
     *
     * @return string|null
     */
    public function getInstagramUrl();

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
     * @return ReviewInterface
     */
    public function setId($id);

    /**
     * Set identifier
     *
     * @param string $identifier
     * @return ReviewInterface
     */
    public function setName($name);

    /**
     * Set title
     *
     * @param string $title
     * @return ReviewInterface
     */
    public function setProfileImg($profileImg);

    /**
     * Set content
     *
     * @param string $content
     * @return ReviewInterface
     */
    public function setDesignation($designation);

    /**
     * Set content
     *
     * @param string $content
     * @return ReviewInterface
     */
    public function setLocation($location);

    /**
     * Set content
     *
     * @param string $content
     * @return ReviewInterface
     */
    public function setContent($content);

    /**
     * Set content
     *
     * @param string $content
     * @return ReviewInterface
     */
    public function setFacebookUrl($facebookUrl);

    /**
     * Set content
     *
     * @param string $content
     * @return ReviewInterface
     */
    public function setTwitterUrl($twitterUrl);

    /**
     * Set content
     *
     * @param string $content
     * @return ReviewInterface
     */
    public function setLinkedinUrl($linkedinUrl);

    /**
     * Set content
     *
     * @param string $content
     * @return ReviewInterface
     */
    public function setInstagramUrl($instagramUrl);

    /**
     * Set content
     *
     * @param string $content
     * @return ReviewInterface
     */
    public function setSortOrder($sortOrder);

    /**
     * Set is active
     *
     * @param bool|int $isActive
     * @return ReviewInterface
     */
    public function setStatus($status);

    /**
     * Set creation time
     *
     * @param string $creationTime
     * @return ReviewInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * Set creation time
     *
     * @param string $creationTime
     * @return ReviewInterface
     */
    public function setUpdatedAt($updatedAt);
}
