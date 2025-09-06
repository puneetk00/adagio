<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace ET\Promotionbar\Model;

use ET\Promotionbar\Api\PromotionRepositoryInterface;
use ET\Promotionbar\Api\Data;
use ET\Promotionbar\Model\ResourceModel\Promotion as ResourcePromotion;
use ET\Promotionbar\Model\ResourceModel\Promotion\CollectionFactory as PromotionCollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class PromotionRepository
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class PromotionRepository implements PromotionRepositoryInterface {

    /**
     * @var ResourcePromotion
     */
    protected $resource;

    /**
     * @var PromotionFactory
     */
    protected $blockFactory;

    /**
     * @var PromotionCollectionFactory
     */
    protected $blockCollectionFactory;

    /**
     * @var Data\PromotionSearchResultsInterfaceFactory
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
     * @var \ET\Promotionbar\Api\Data\PromotionInterfaceFactory
     */
    protected $dataPromotionFactory;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @param ResourcePromotion $resource
     * @param PromotionFactory $blockFactory
     * @param Data\PromotionInterfaceFactory $dataPromotionFactory
     * @param PromotionCollectionFactory $blockCollectionFactory
     * @param Data\PromotionSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
    ResourcePromotion $resource, PromotionFactory $blockFactory, \ET\Promotionbar\Api\Data\PromotionInterfaceFactory $dataPromotionFactory, PromotionCollectionFactory $blockCollectionFactory, Data\PromotionSearchResultsInterfaceFactory $searchResultsFactory, DataObjectHelper $dataObjectHelper, DataObjectProcessor $dataObjectProcessor, StoreManagerInterface $storeManager, CollectionProcessorInterface $collectionProcessor = null
    ) {
        $this->resource = $resource;
        $this->blockFactory = $blockFactory;
        $this->blockCollectionFactory = $blockCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataPromotionFactory = $dataPromotionFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor ?: $this->getCollectionProcessor();
    }

    /**
     * Save Promotion data
     *
     * @param \ET\Promotionbar\Api\Data\PromotionInterface $block
     * @return Promotion
     * @throws CouldNotSaveException
     */
    public function save(Data\PromotionInterface $block) {
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
     * Load Promotion data by given Promotion Identity
     *
     * @param string $blockId
     * @return Promotion
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
     * Load Promotion data collection by given search criteria
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @param \Magento\Framework\Api\SearchCriteriaInterface $criteria
     * @return \ET\Promotionbar\Api\Data\PromotionSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $criteria) {
        /** @var \ET\Promotionbar\Model\ResourceModel\Promotion\Collection $collection */
        $collection = $this->blockCollectionFactory->create();

        $this->collectionProcessor->process($criteria, $collection);

        /** @var Data\PromotionSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * Delete Promotion
     *
     * @param \ET\Promotionbar\Api\Data\PromotionInterface $block
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(Data\PromotionInterface $block) {
        try {
            $this->resource->delete($block);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    /**
     * Delete Promotion by given Promotion Identity
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
