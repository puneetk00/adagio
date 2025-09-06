<?php
use Magento\Framework\App\Bootstrap;

require __DIR__ . '/app/bootstrap.php';

$params = $_SERVER;
$bootstrap = Bootstrap::create(BP, $params);
$obj = $bootstrap->getObjectManager();
$state = $obj->get('Magento\Framework\App\State');
$state->setAreaCode('adminhtml');

$eavSetupFactory = $obj->get(\Magento\Eav\Setup\EavSetupFactory::class);
$attributeSetFactory = $obj->get(\Magento\Eav\Model\Entity\Attribute\SetFactory::class);
$entityType = $obj->get(\Magento\Eav\Model\Entity\Type::class);
$eavConfig = $obj->get(\Magento\Eav\Model\Config::class);

$eavSetup = $eavSetupFactory->create(['setup' => $obj->get('Magento\Framework\Setup\ModuleDataSetupInterface')]);

$entityTypeId = $eavConfig->getEntityType(\Magento\Catalog\Model\Product::ENTITY)->getEntityTypeId();

// Load exported JSON
$jsonFile = __DIR__ . '/attribute_sets_export.json';
if (!file_exists($jsonFile)) {
    die("❌ Export file not found: $jsonFile\n");
}

$data = json_decode(file_get_contents($jsonFile), true);

// Process each attribute set
foreach ($data as $setData) {
    $attributeSetName = $setData['attribute_set_name'];

    echo "➡️ Importing Attribute Set: $attributeSetName\n";

    // Check if attribute set already exists
    $attributeSet = $attributeSetFactory->create()->load($attributeSetName, 'attribute_set_name');
    if (!$attributeSet->getId()) {
        $defaultSetId = $eavConfig->getEntityType(\Magento\Catalog\Model\Product::ENTITY)->getDefaultAttributeSetId();
        $attributeSet->setEntityTypeId($entityTypeId)
            ->setAttributeSetName($attributeSetName);
        $attributeSet->validate();
        $attributeSet->save();
        $attributeSet->initFromSkeleton($defaultSetId)->save();
        echo "✅ Created new attribute set: $attributeSetName\n";
    } else {
        echo "⚠️ Attribute set already exists: $attributeSetName (skipping creation)\n";
    }

    // Import attributes
    foreach ($setData['attributes'] as $attr) {
        if (!$attr['is_user_defined']) {
            echo "   ⏩ Skipping system attribute: {$attr['attribute_code']}\n";
            continue;
        }

        $attributeCode = $attr['attribute_code'];
        $existingAttr = $eavConfig->getAttribute(\Magento\Catalog\Model\Product::ENTITY, $attributeCode);

        if ($existingAttr && $existingAttr->getId()) {
            echo "   ⚠️ Attribute already exists: $attributeCode (skipping)\n";
            continue;
        }

        echo "   ➕ Creating attribute: $attributeCode\n";

        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            $attributeCode,
            [
                'type' => $attr['backend_type'] ?? 'varchar',
                'label' => $attr['frontend_label'] ?? $attributeCode,
                'input' => $attr['frontend_input'] ?? 'text',
                'required' => (bool)$attr['is_required'],
                'user_defined' => (bool)$attr['is_user_defined'],
                'default' => $attr['default_value'] ?? '',
                'visible' => true,
                'system' => 0,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'group' => 'General',
            ]
        );

        // Assign to attribute set
        $newAttribute = $eavConfig->getAttribute(\Magento\Catalog\Model\Product::ENTITY, $attributeCode);
        if ($newAttribute && $newAttribute->getId()) {
            $eavSetup->addAttributeToSet(
                \Magento\Catalog\Model\Product::ENTITY,
                $attributeSet->getId(),
                'General',
                $newAttribute->getId()
            );
        }
    }
}

echo "🎉 Import finished!\n";
