<?php

namespace ET\Bannerslider\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface {

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context) {

        $installer = $setup;

        $installer->startSetup();

        if (!$installer->tableExists('et_bannerslider')) {
            $table = $installer->getConnection()->newTable(
                            $installer->getTable('et_bannerslider')
                    )->addColumn(
                            'id', Table::TYPE_INTEGER, null, [
                        'identity' => true,
                        'nullable' => false,
                        'primary' => true,
                        'unsigned' => true,
                            ], 'ID'
                    )->addColumn(
                            'name', Table::TYPE_TEXT, 255, [
                        'nullable => false',
                            ], 'Name'
                    )->addColumn(
                            'img', Table::TYPE_TEXT, 255, [
                        'nullable => false',
                            ], 'Image'
                    )->addColumn(
                            'link', Table::TYPE_TEXT, 255, [
                        'nullable => false',
                            ], 'Link'
                    )->addColumn(
                            'target', Table::TYPE_INTEGER, null, [
                        'nullable' => false,
                            ], 'Target'
                    )->addColumn(
                            'content', Table::TYPE_TEXT, '2M', [], 'Banner Content'
                    )->addColumn(
                            'content_position', Table::TYPE_INTEGER, null, ['nullable => false'], 'Content Position'
                    )->addColumn(
                            'disable_mobile', Table::TYPE_INTEGER, null, ['nullable => false'], 'Disable Mobile'
                    )->addColumn(
                            'start_date', Table::TYPE_DATETIME, null, [], 'Start Date'
                    )->addColumn(
                            'end_date', Table::TYPE_DATETIME, null, ['nullable => false'], 'End Date'
                    )->addColumn(
                            'sort_order', Table::TYPE_INTEGER, 255, ['nullable => false'], 'Sort Order'
                    )->addColumn(
                            'status', Table::TYPE_INTEGER, null, [
                        'nullable' => false,
                            ], 'Status'
                    )->addColumn(
                            'created_at', \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP, null, [], 'Created At'
                    )->addColumn(
                            'updated_at', \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP, null, [], 'Updated At'
                    )->setComment('Banner Slider');
            $installer->getConnection()->createTable($table);


            $installer->getConnection()->addIndex(
                    $installer->getTable('et_bannerslider'), $setup->getIdxName(
                            $installer->getTable('et_bannerslider'), ['name'], \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                    ), ['name'], \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            );
        }

        if (!$installer->tableExists('et_bannerslider_store')) {
            $table = $installer->getConnection()->newTable(
                            $installer->getTable('et_bannerslider_store')
                    )->addColumn('id', Table::TYPE_INTEGER, null, ['unsigned' => true, 'nullable' => false, 'primary' => true], 'Banner Slider ID'
                    )->addColumn('store_id', Table::TYPE_SMALLINT, null, ['unsigned' => true, 'nullable' => false, 'primary' => true], 'Store ID'
                    )->addIndex($installer->getIdxName('et_bannerslider_store', ['store_id']), ['store_id']
                    )->addForeignKey(
                            $installer->getFkName('et_bannerslider_store', 'id', 'banner', 'model_id'), 'id', $installer->getTable('et_bannerslider'), 'id', Table::ACTION_CASCADE
                    )->addForeignKey(
                            $installer->getFkName('et_bannerslider_store', 'store_id', 'store', 'store_id'), 'store_id', $installer->getTable('store'), 'store_id', Table::ACTION_CASCADE
                    )->setComment(
                    'Banner Slider To Store Linkage Table'
            );
            $installer->getConnection()->createTable($table);
        }
        $installer->endSetup();
    }

}
