<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace ET\Orderfeedback\Api\Data;

/**
 * CMS block interface.
 * @api
 * @since 100.0.2
 */
interface FeedbackInterface {
    /*     * #@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */

    const FEEDBACK_ID = 'id';
    const ORDER_ID = 'order_id';
    const CUSTOMER_ID = 'customer_id';
    const CUSTOMER_NAME = 'customer_name';
    const CUSTOMER_EMAIL = 'customer_email';
    const RATING = 'rating';
    const CONTENT = 'content';
    const CREATED_AT = 'created_at';

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
    public function getOrderId();

    /**
     * Get title
     *
     * @return string|null
     */
    public function getCustomerId();

    /**
     * Get title
     *
     * @return string|null
     */
    public function getCustomerName();

    /**
     * Get title
     *
     * @return string|null
     */
    public function getCustomerEmail();

    /**
     * Get content
     *
     * @return string|null
     */
    public function getRating();

    /**
     * Get content
     *
     * @return string|null
     */
    public function getContent();

    /**
     * Get creation time
     *
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set ID
     *
     * @param int $id
     * @return FeedbackInterface
     */
    public function setId($id);

    /**
     * Set identifier
     *
     * @param string $identifier
     * @return FeedbackInterface
     */
    public function setOrderId($orderId);

    /**
     * Set title
     *
     * @param string $title
     * @return FeedbackInterface
     */
    public function setCustomerId($customerId);

    /**
     * Set title
     *
     * @param string $title
     * @return FeedbackInterface
     */
    public function setCustomerName($customerName);

    /**
     * Set title
     *
     * @param string $title
     * @return FeedbackInterface
     */
    public function setCustomerEmail($customerEmail);

    /**
     * Set content
     *
     * @param string $content
     * @return FeedbackInterface
     */
    public function setRating($rating);

    /**
     * Set content
     *
     * @param string $content
     * @return FeedbackInterface
     */
    public function setContent($content);

    /**
     * Set creation time
     *
     * @param string $creationTime
     * @return FeedbackInterface
     */
    public function setCreatedAt($createdAt);
}
