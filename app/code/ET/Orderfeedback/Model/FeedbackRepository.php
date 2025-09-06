<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace ET\Orderfeedback\Model;

use ET\Orderfeedback\Api\FeedbackRepositoryInterface;
use ET\Orderfeedback\Api\Data;
use ET\Orderfeedback\Model\ResourceModel\Feedback as ResourceFeedback;
use ET\Orderfeedback\Model\ResourceModel\Feedback\CollectionFactory as FeedbackCollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class FeedbackRepository
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class FeedbackRepository implements FeedbackRepositoryInterface {

    /**
     * @var ResourceFeedback
     */
    protected $resource;

    /**
     * @var FeedbackFactory
     */
    protected $blockFactory;

    /**
     * @var FeedbackCollectionFactory
     */
    protected $blockCollectionFactory;

    /**
     * @var Data\FeedbackSearchResultsInterfaceFactory
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
     * @var \ET\Orderfeedback\Api\Data\FeedbackInterfaceFactory
     */
    protected $dataFeedbackFactory;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @param ResourceFeedback $resource
     * @param FeedbackFactory $blockFactory
     * @param Data\FeedbackInterfaceFactory $dataFeedbackFactory
     * @param FeedbackCollectionFactory $blockCollectionFactory
     * @param Data\FeedbackSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
    ResourceFeedback $resource, FeedbackFactory $blockFactory, \ET\Orderfeedback\Api\Data\FeedbackInterfaceFactory $dataFeedbackFactory, FeedbackCollectionFactory $blockCollectionFactory, Data\FeedbackSearchResultsInterfaceFactory $searchResultsFactory, DataObjectHelper $dataObjectHelper, DataObjectProcessor $dataObjectProcessor, StoreManagerInterface $storeManager, CollectionProcessorInterface $collectionProcessor = null
    ) {
        $this->resource = $resource;
        $this->blockFactory = $blockFactory;
        $this->blockCollectionFactory = $blockCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataFeedbackFactory = $dataFeedbackFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor ?: $this->getCollectionProcessor();
    }

    /**
     * Save Feedback data
     *
     * @param \ET\Orderfeedback\Api\Data\FeedbackInterface $block
     * @return Feedback
     * @throws CouldNotSaveException
     */
    public function save(Data\FeedbackInterface $block) {
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
     * Load Feedback data by given Feedback Identity
     *
     * @param string $blockId
     * @return Feedback
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
     * Load Feedback data collection by given search criteria
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @param \Magento\Framework\Api\SearchCriteriaInterface $criteria
     * @return \ET\Orderfeedback\Api\Data\FeedbackSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $criteria) {
        /** @var \ET\Orderfeedback\Model\ResourceModel\Feedback\Collection $collection */
        $collection = $this->blockCollectionFactory->create();

        $this->collectionProcessor->process($criteria, $collection);

        /** @var Data\FeedbackSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * Delete Feedback
     *
     * @param \ET\Orderfeedback\Api\Data\FeedbackInterface $block
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(Data\FeedbackInterface $block) {
        try {
            $this->resource->delete($block);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    /**
     * Delete Feedback by given Feedback Identity
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
