<?php

namespace ET\Clientreviews\Setup;

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

        if (!$installer->tableExists('et_clientreviews')) {
            $table = $installer->getConnection()->newTable(
                            $installer->getTable('et_clientreviews')
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
                            'profile_img', Table::TYPE_TEXT, 255, [
                        'nullable => false',
                            ], 'Profile Image'
                    )->addColumn(
                            'designation', Table::TYPE_TEXT, 255, [
                        'nullable => false',
                            ], 'Designation'
                    )->addColumn(
                            'location', Table::TYPE_TEXT, 255, [
                        'nullable => false',
                            ], 'Location'
                    )->addColumn(
                            'content', Table::TYPE_TEXT, '2M', [], 'Review Content'
                    )->addColumn(
                            'facebook_url', Table::TYPE_TEXT, 255, [
                        'nullable => false',
                            ], 'Facebook URL'
                    )->addColumn(
                            'twitter_url', Table::TYPE_TEXT, 255, [
                        'nullable => false',
                            ], 'Twitter URL'
                    )->addColumn(
                            'linkedin_url', Table::TYPE_TEXT, 255, [
                        'nullable => false',
                            ], 'LinkedIn URL'
                    )->addColumn(
                            'instagram_url', Table::TYPE_TEXT, 255, [
                        'nullable => false',
                            ], 'Instagram URL'
                    )
                    ->addColumn(
                            'sort_order', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, 255, ['nullable => false'], 'Sort Order'
                    )->addColumn(
                            'status', Table::TYPE_SMALLINT, null, [
                        'nullable' => false,
                            ], 'Status'
                    )->addColumn(
                            'created_at', Table::TYPE_TIMESTAMP, null, [
                        'nullable' => false,
                        'default' => Table::TIMESTAMP_INIT,
                            ], 'Created At'
                    )->addColumn(
                            'updated_at', \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP, null, [], 'Updated At'
                    )
                    ->setComment('Review Slider');
            $installer->getConnection()->createTable($table);


            $installer->getConnection()->addIndex(
                    $installer->getTable('et_clientreviews'), $setup->getIdxName(
                            $installer->getTable('et_clientreviews'), ['name', 'designation', 'location'], \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                    ), ['name', 'designation', 'location'], \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            );
        }

        if (!$installer->tableExists('et_clientreviews_store')) {
            $table = $installer->getConnection()->newTable(
                            $installer->getTable('et_clientreviews_store')
                    )->addColumn('id', Table::TYPE_INTEGER, null, ['unsigned' => true, 'nullable' => false, 'primary' => true], 'Review Slider ID'
                    )->addColumn('store_id', Table::TYPE_SMALLINT, null, ['unsigned' => true, 'nullable' => false, 'primary' => true], 'Store ID'
                    )->addIndex($installer->getIdxName('et_clientreviews_store', ['store_id']), ['store_id']
                    )->addForeignKey(
                            $installer->getFkName('et_clientreviews_store', 'id', 'store', 'id'), 'id', $installer->getTable('et_clientreviews'), 'id', Table::ACTION_CASCADE
                    )->addForeignKey(
                            $installer->getFkName('et_clientreviews_store', 'store_id', 'store', 'store_id'), 'store_id', $installer->getTable('store'), 'store_id', Table::ACTION_CASCADE
                    )->setComment(
                    'Client Reviews To Store Linkage Table'
            );
            $installer->getConnection()->createTable($table);
        }
        $installer->endSetup();
    }

}
