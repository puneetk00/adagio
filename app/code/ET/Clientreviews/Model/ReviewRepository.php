<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace ET\Clientreviews\Model;

use ET\Clientreviews\Api\ReviewRepositoryInterface;
use ET\Clientreviews\Api\Data;
use ET\Clientreviews\Model\ResourceModel\Review as ResourceReview;
use ET\Clientreviews\Model\ResourceModel\Review\CollectionFactory as ReviewCollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class ReviewRepository
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class ReviewRepository implements ReviewRepositoryInterface {

    /**
     * @var ResourceReview
     */
    protected $resource;

    /**
     * @var ReviewFactory
     */
    protected $blockFactory;

    /**
     * @var ReviewCollectionFactory
     */
    protected $blockCollectionFactory;

    /**
     * @var Data\ReviewSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * @var DataObjectProcessor
     */
    protected $dataObjectProcessor;

    /**
     * @var \ET\Clientreviews\Api\Data\ReviewInterfaceFactory
     */
    protected $dataReviewFactory;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @param ResourceReview $resource
     * @param ReviewFactory $blockFactory
     * @param Data\ReviewInterfaceFactory $dataReviewFactory
     * @param ReviewCollectionFactory $blockCollectionFactory
     * @param Data\ReviewSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
    ResourceReview $resource, ReviewFactory $blockFactory, \ET\Clientreviews\Api\Data\ReviewInterfaceFactory $dataReviewFactory, ReviewCollectionFactory $blockCollectionFactory, Data\ReviewSearchResultsInterfaceFactory $searchResultsFactory, DataObjectHelper $dataObjectHelper, DataObjectProcessor $dataObjectProcessor, StoreManagerInterface $storeManager, CollectionProcessorInterface $collectionProcessor = null
    ) {
        $this->resource = $resource;
        $this->blockFactory = $blockFactory;
        $this->blockCollectionFactory = $blockCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataReviewFactory = $dataReviewFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor ?: $this->getCollectionProcessor();
    }

    /**
     * Save Review data
     *
     * @param \ET\Clientreviews\Api\Data\ReviewInterface $block
     * @return Review
     * @throws CouldNotSaveException
     */
    public function save(Data\ReviewInterface $block) {
        if (empty($block->getStoreId())) {
            $block->setStoreId($this->storeManager->getStore()->getId());
        }

        try {
            $this->resource->save($block);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $block;
    }

    /**
     * Load Review data by given Review Identity
     *
     * @param string $blockId
     * @return Review
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($blockId) {
        $block = $this->blockFactory->create();
        $this->resource->load($block, $blockId);
        if (!$block->getId()) {
            throw new NoSuchEntityException(__('The CMS block with the "%1" ID doesn\'t exist.', $blockId));
        }
        return $block;
    }

    /**
     * Load Review data collection by given search criteria
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @param \Magento\Framework\Api\SearchCriteriaInterface $criteria
     * @return \ET\Clientreviews\Api\Data\ReviewSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $criteria) {
        /** @var \ET\Clientreviews\Model\ResourceModel\Review\Collection $collection */
        $collection = $this->blockCollectionFactory->create();

        $this->collectionProcessor->process($criteria, $collection);

        /** @var Data\ReviewSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * Delete Review
     *
     * @param \ET\Clientreviews\Api\Data\ReviewInterface $block
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(Data\ReviewInterface $block) {
        try {
            $this->resource->delete($block);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    /**
     * Delete Review by given Review Identity
     *
     * @param string $blockId
     * @return bool
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($blockId) {
        return $this->delete($this->getById($blockId));
    }

    /**
     * Retrieve collection processor
     *
     * @deprecated 102.0.0
     * @return CollectionProcessorInterface
     */
    private function getCollectionProcessor() {
        if (!$this->collectionProcessor) {
            $this->collectionProcessor = \Magento\Framework\App\ObjectManager::getInstance()->get(
                    'Magento\Cms\Model\Api\SearchCriteria\BlockCollectionProcessor'
            );
        }
        return $this->collectionProcessor;
    }

}
