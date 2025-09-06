<?php

namespace ET\Orderfeedback\Setup;

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

        if (!$installer->tableExists('et_orderfeedback')) {
            $table = $installer->getConnection()->newTable(
                            $installer->getTable('et_orderfeedback')
                    )->addColumn(
                            'id', Table::TYPE_INTEGER, null, [
                        'identity' => true,
                        'nullable' => false,
                        'primary' => true,
                        'unsigned' => true,
                            ], 'ID'
                    )->addColumn(
                            'order_id', Table::TYPE_TEXT, 255, [
                        'nullable => false',
                            ], 'order id'
                    )->addColumn(
                            'customer_id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, ['nullable => false'], 'customer id'
                    )->addColumn(
                            'customer_name', Table::TYPE_TEXT, 255, [
                        'nullable => false',
                            ], 'customer_name'
                    )->addColumn(
                            'customer_email', Table::TYPE_TEXT, 255, [
                        'nullable => false',
                            ], 'customer_email'
                    )->addColumn(
                            'rating', Table::TYPE_TEXT, 255, [
                        'nullable => false',
                            ], 'rating'
                    )->addColumn(
                            'content', Table::TYPE_TEXT, '2M', [], 'Feedback Content'
                    )->addColumn(
                            'created_at', Table::TYPE_TIMESTAMP, null, [
                        'nullable' => false,
                        'default' => Table::TIMESTAMP_INIT,
                            ], 'Created At'
                    )->setComment('Order Feedback');
            $installer->getConnection()->createTable($table);


            $installer->getConnection()->addIndex(
                    $installer->getTable('et_orderfeedback'), $setup->getIdxName(
                            $installer->getTable('et_orderfeedback'), ['customer_name', 'customer_email', 'content'], \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                    ), ['customer_name', 'customer_email', 'content'], \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            );
        }

        if (!$installer->tableExists('et_orderfeedback_store')) {
            $table = $installer->getConnection()->newTable(
                            $installer->getTable('et_orderfeedback_store')
                    )->addColumn('id', Table::TYPE_INTEGER, null, ['unsigned' => true, 'nullable' => false, 'primary' => true], 'Feedback ID'
                    )->addColumn('store_id', Table::TYPE_SMALLINT, null, ['unsigned' => true, 'nullable' => false, 'primary' => true], 'Store ID'
                    )->addIndex($installer->getIdxName('et_orderfeedback_store', ['store_id']), ['store_id']
                    )->addForeignKey(
                            $installer->getFkName('et_orderfeedback_store', 'id', 'feedback', 'model_id'), 'id', $installer->getTable('et_orderfeedback'), 'id', Table::ACTION_CASCADE
                    )->addForeignKey(
                            $installer->getFkName('et_orderfeedback_store', 'store_id', 'store', 'store_id'), 'store_id', $installer->getTable('store'), 'store_id', Table::ACTION_CASCADE
                    )->setComment(
                    'Feedback To Store Linkage Table'
            );
            $installer->getConnection()->createTable($table);
        }
        $installer->endSetup();
    }

}
