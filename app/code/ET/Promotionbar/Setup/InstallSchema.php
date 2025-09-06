<?php

namespace ET\Promotionbar\Setup;

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

        if (!$installer->tableExists('et_promotionbar')) {
            $table = $installer->getConnection()->newTable(
                            $installer->getTable('et_promotionbar')
                    )
                    ->addColumn(
                            'id', \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT, null, ['identity' => true, 'nullable' => false, 'primary' => true], 'Promotion ID'
                    )
                    ->addColumn(
                            'promo_style', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, ['nullable => false'], 'Promotion Style'
                    )
                    ->addColumn(
                            'promo_text', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255, ['nullable => false'], 'Promotion Text'
                    )
                    ->addColumn(
                            'backcolor', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255, ['nullable => false'], 'Background Color'
                    )
                    ->addColumn(
                            'textcolor', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255, ['nullable => false'], 'Text Color'
                    )
                    ->addColumn(
                            'btn_enable', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, ['nullable => false'], 'Enable Button'
                    )
                    ->addColumn(
                            'btn_style', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, ['nullable => false'], 'Button Style'
                    )
                    ->addColumn(
                            'btn_text', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255, ['nullable => false'], 'Button Text'
                    )
                    ->addColumn(
                            'btn_url', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255, ['nullable => false'], 'Button URL'
                    )
                    ->addColumn(
                            'btn_target', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, ['nullable => false'], 'Button Target'
                    )
                    ->addColumn(
                            'btn_backcolor', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255, ['nullable => false'], 'Button Background Color'
                    )
                    ->addColumn(
                            'btn_textcolor', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255, ['nullable => false'], 'Button Text Color'
                    )
                    ->addColumn(
                            'sub_enable', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, ['nullable => false'], 'Enable Newsletter Subscription'
                    )
                    ->addColumn(
                            'sub_text_placeholder', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255, ['nullable => false'], 'Subscription Placeholder Text'
                    )
                    ->addColumn(
                            'sub_btn_text', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255, ['nullable => false'], 'Subscription Button Text'
                    )
                    ->addColumn(
                            'sub_btn_backcolor', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255, ['nullable => false'], 'Subscription Button Background Color'
                    )
                    ->addColumn(
                            'sub_btn_textcolor', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255, ['nullable => false'], 'Subscription Button Text Color'
                    )
                    ->addColumn(
                            'timer_enable', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, ['nullable => false'], 'Enable Timer'
                    )
                    ->addColumn(
                            'timer_enddate', \Magento\Framework\DB\Ddl\Table::TYPE_DATETIME, null, [], 'Timer Start Date'
                    )
                    ->addColumn(
                            'start_date', \Magento\Framework\DB\Ddl\Table::TYPE_DATETIME, null, [], 'Start Date'
                    )
                    ->addColumn(
                            'end_date', \Magento\Framework\DB\Ddl\Table::TYPE_DATETIME, null, ['nullable => false'], 'End Date'
                    )
                    ->addColumn(
                            'sort_order', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, 255, ['nullable => false'], 'Sort Order'
                    )
                    ->addColumn(
                            'status', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, ['nullable => false'], 'Promotion Bar Status'
                    )
                    ->addColumn(
                            'created_at', \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP, null, [], 'Promotion Bar Created At'
                    )
                    ->addColumn(
                            'updated_at', \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP, null, [], 'Promotion Bar Updated At'
                    )
                    ->setComment('Promotion Bar Table');
            $installer->getConnection()->createTable($table);


            $installer->getConnection()->addIndex(
                    $installer->getTable('et_promotionbar'), $setup->getIdxName(
                            $installer->getTable('et_promotionbar'), ['promo_text'], \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                    ), ['promo_text'], \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            );
        }

        if (!$installer->tableExists('et_promotionbar_store')) {
            $table = $installer->getConnection()->newTable(
                            $installer->getTable('et_promotionbar_store')
                    )->addColumn(
                            'id', \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT, null, ['nullable' => false, 'primary' => true], 'Promotion ID'
                    )->addColumn(
                            'store_id', \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT, null, ['unsigned' => true, 'nullable' => false, 'primary' => true], 'Store ID'
                    )->addIndex(
                            $installer->getIdxName('et_promotionbar_store', ['store_id']), ['store_id']
                    )->addForeignKey(
                            $installer->getFkName('et_promotionbar_store', 'store_id', 'store', 'store_id'), 'store_id', $installer->getTable('store'), 'store_id', \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                    )->setComment(
                    'Promotion Bar To Store Linkage Table'
            );
            $installer->getConnection()->createTable($table);
        }
        $installer->endSetup();
    }

}
