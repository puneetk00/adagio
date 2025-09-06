<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace ET\Bannerslider\Model;

use ET\Bannerslider\Api\BannerRepositoryInterface;
use ET\Bannerslider\Api\Data;
use ET\Bannerslider\Model\ResourceModel\Banner as ResourceBanner;
use ET\Bannerslider\Model\ResourceModel\Banner\CollectionFactory as BannerCollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class BannerRepository
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class BannerRepository implements BannerRepositoryInterface {

    /**
     * @var ResourceBanner
     */
    protected $resource;

    /**
     * @var BannerFactory
     */
    protected $blockFactory;

    /**
     * @var BannerCollectionFactory
     */
    protected $blockCollectionFactory;

    /**
     * @var Data\BannerSearchResultsInterfaceFactory
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
     * @var \ET\Bannerslider\Api\Data\BannerInterfaceFactory
     */
    protected $dataBannerFactory;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @param ResourceBanner $resource
     * @param BannerFactory $blockFactory
     * @param Data\BannerInterfaceFactory $dataBannerFactory
     * @param BannerCollectionFactory $blockCollectionFactory
     * @param Data\BannerSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
    ResourceBanner $resource, BannerFactory $blockFactory, \ET\Bannerslider\Api\Data\BannerInterfaceFactory $dataBannerFactory, BannerCollectionFactory $blockCollectionFactory, Data\BannerSearchResultsInterfaceFactory $searchResultsFactory, DataObjectHelper $dataObjectHelper, DataObjectProcessor $dataObjectProcessor, StoreManagerInterface $storeManager, CollectionProcessorInterface $collectionProcessor = null
    ) {
        $this->resource = $resource;
        $this->blockFactory = $blockFactory;
        $this->blockCollectionFactory = $blockCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataBannerFactory = $dataBannerFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor ?: $this->getCollectionProcessor();
    }

    /**
     * Save Banner data
     *
     * @param \ET\Bannerslider\Api\Data\BannerInterface $block
     * @return Banner
     * @throws CouldNotSaveException
     */
    public function save(Data\BannerInterface $block) {
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
     * Load Banner data by given Banner Identity
     *
     * @param string $blockId
     * @return Banner
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
     * Load Banner data collection by given search criteria
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @param \Magento\Framework\Api\SearchCriteriaInterface $criteria
     * @return \ET\Bannerslider\Api\Data\BannerSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $criteria) {
        /** @var \ET\Bannerslider\Model\ResourceModel\Banner\Collection $collection */
        $collection = $this->blockCollectionFactory->create();

        $this->collectionProcessor->process($criteria, $collection);

        /** @var Data\BannerSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * Delete Banner
     *
     * @param \ET\Bannerslider\Api\Data\BannerInterface $block
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(Data\BannerInterface $block) {
        try {
            $this->resource->delete($block);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    /**
     * Delete Banner by given Banner Identity
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
