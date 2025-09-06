<?php

namespace ET\Navigationmenu\Setup;

use Magento\Framework\Module\Setup\Migration;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Catalog\Setup\CategorySetupFactory;

/**
 * @codeCoverageIgnore
 */
class InstallData implements InstallDataInterface {

    /**
     * Category setup factory
     *
     * @var CategorySetupFactory
     */
    private $categorySetupFactory;

    /**
     * Init
     *
     * @param CategorySetupFactory $categorySetupFactory
     */
    public function __construct(CategorySetupFactory $categorySetupFactory) {
        $this->categorySetupFactory = $categorySetupFactory;
    }

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context) {
        $installer = $setup;

        $installer->startSetup();

        $categorySetup = $this->categorySetupFactory->create(['setup' => $setup]);
        $entityTypeId = $categorySetup->getEntityTypeId(\Magento\Catalog\Model\Category::ENTITY);
        $attributeSetId = $categorySetup->getDefaultAttributeSetId($entityTypeId);

        $menu_attributes = [
            'menu_hide_item' => [
                'type' => 'int',
                'label' => 'Hide This Menu',
                'input' => 'select',
                'source' => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
                'required' => false,
                'sort_order' => 10,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'group' => 'Mega Menu'
            ],
            'menu_type' => [
                'type' => 'varchar',
                'label' => 'Menu Style',
                'input' => 'select',
                'source' => 'ET\Navigationmenu\Model\Attribute\Menutype',
                'required' => false,
                'sort_order' => 20,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'group' => 'Mega Menu'
            ],
            'menu_static_width' => [
                'type' => 'varchar',
                'label' => 'Static Width',
                'input' => 'text',
                'required' => false,
                'sort_order' => 30,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'group' => 'Mega Menu'
            ],
            'menu_cat_columns' => [
                'type' => 'varchar',
                'label' => 'Sub Category Columns',
                'input' => 'select',
                'source' => 'ET\Navigationmenu\Model\Attribute\Subcatcolumns',
                'required' => false,
                'sort_order' => 40,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'group' => 'Mega Menu'
            ],
            'menu_float_type' => [
                'type' => 'varchar',
                'label' => 'Float Type',
                'input' => 'select',
                'source' => 'ET\Navigationmenu\Model\Attribute\Floattype',
                'required' => false,
                'sort_order' => 50,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'group' => 'Mega Menu'
            ],
            'menu_cat_label' => [
                'type' => 'varchar',
                'label' => 'Category Label',
                'input' => 'select',
                'source' => 'ET\Navigationmenu\Model\Attribute\Categorylabel',
                'required' => false,
                'sort_order' => 60,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'group' => 'Mega Menu'
            ],
            'menu_icon_img' => [
                'type' => 'varchar',
                'label' => 'Icon Image',
                'input' => 'image',
                'backend' => 'Magento\Catalog\Model\Category\Attribute\Backend\Image',
                'required' => false,
                'sort_order' => 70,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'group' => 'Mega Menu'
            ],
            'menu_font_icon' => [
                'type' => 'varchar',
                'label' => 'Font Icon Class',
                'input' => 'text',
                'required' => false,
                'sort_order' => 80,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'group' => 'Mega Menu'
            ],
            'menu_block_top_content' => [
                'type' => 'text',
                'label' => 'Header Block',
                'input' => 'textarea',
                'required' => false,
                'sort_order' => 90,
                'wysiwyg_enabled' => true,
                'is_html_allowed_on_front' => true,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'group' => 'Mega Menu'
            ],
            'menu_block_left_width' => [
                'type' => 'varchar',
                'label' => 'Left Block Width',
                'input' => 'select',
                'source' => 'ET\Navigationmenu\Model\Attribute\Width',
                'required' => false,
                'sort_order' => 100,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'group' => 'Mega Menu'
            ],
            'menu_block_left_content' => [
                'type' => 'text',
                'label' => 'Left Block',
                'input' => 'textarea',
                'required' => false,
                'sort_order' => 110,
                'wysiwyg_enabled' => true,
                'is_html_allowed_on_front' => true,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'group' => 'Mega Menu'
            ],
            'menu_block_right_width' => [
                'type' => 'varchar',
                'label' => 'Right Block Width',
                'input' => 'select',
                'source' => 'ET\Navigationmenu\Model\Attribute\Width',
                'required' => false,
                'sort_order' => 120,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'group' => 'Mega Menu'
            ],
            'menu_block_right_content' => [
                'type' => 'text',
                'label' => 'Right Block',
                'input' => 'textarea',
                'required' => false,
                'sort_order' => 130,
                'wysiwyg_enabled' => true,
                'is_html_allowed_on_front' => true,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'group' => 'Mega Menu'
            ],
            'menu_block_bottom_content' => [
                'type' => 'text',
                'label' => 'Footer Block',
                'input' => 'textarea',
                'required' => false,
                'sort_order' => 140,
                'wysiwyg_enabled' => true,
                'is_html_allowed_on_front' => true,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'group' => 'Mega Menu'
            ],
            'menu_back_color' => [
                'type' => 'varchar',
                'label' => 'Background Color',
                'input' => 'text',
                'required' => false,
                'sort_order' => 150,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'group' => 'Mega Menu'
            ],
            'menu_back_img' => [
                'type' => 'varchar',
                'label' => 'Background Image',
                'input' => 'image',
                'backend' => 'Magento\Catalog\Model\Category\Attribute\Backend\Image',
                'required' => false,
                'sort_order' => 160,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'group' => 'Mega Menu'
            ],
            'menu_back_style' => [
                'type' => 'text',
                'label' => 'Background Custom Style',
                'input' => 'textarea',
                'required' => false,
                'sort_order' => 170,
                'wysiwyg_enabled' => false,
                'is_html_allowed_on_front' => true,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'group' => 'Mega Menu'
            ],
        ];

        foreach ($menu_attributes as $item => $data) {
            $categorySetup->addAttribute(\Magento\Catalog\Model\Category::ENTITY, $item, $data);
        }

        $idg = $categorySetup->getAttributeGroupId($entityTypeId, $attributeSetId, 'Mega Menu');

        foreach ($menu_attributes as $item => $data) {
            $categorySetup->addAttributeToGroup(
                    $entityTypeId, $attributeSetId, $idg, $item, $data['sort_order']
            );
        }

        $installer->endSetup();
    }

}
