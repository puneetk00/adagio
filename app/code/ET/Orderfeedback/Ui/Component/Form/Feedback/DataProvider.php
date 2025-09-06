<?php

namespace ET\Orderfeedback\Ui\Component\Form\Feedback;

use Magento\Store\Model\StoreManagerInterface;
use ET\Orderfeedback\Model\ResourceModel\Feedback\Collection;
use Magento\Framework\View\Element\UiComponent\DataProvider\FilterPool;
use Magento\Framework\App\RequestInterface;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider {

    /**
     * @var Collection
     */
    protected $collection;

    /**
     * @var FilterPool
     */
    protected $filterPool;

    /**
     * @var array
     */
    protected $loadedData;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    public function __construct(
    $name, $primaryFieldName, $requestFieldName, Collection $collection, FilterPool $filterPool, RequestInterface $request, \Magento\Store\Model\StoreManagerInterface $storeManager, array $meta = [], array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collection;
        $this->filterPool = $filterPool;
        $this->request = $request;
        $this->storeManager = $storeManager;
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData() {
        if (!$this->loadedData) {
            $storeId = (int) $this->request->getParam('store');
            $this->collection->setStoreId($storeId)->addAttributeToSelect('*');
            $items = $this->collection->getItems();
            foreach ($items as $item) {
                $item->setStoreId($storeId);
                $itemData = $item->getData();
                $this->loadedData[$item->getEntityId()] = $itemData;
                break;
            }
        }
        return $this->loadedData;
    }

}
