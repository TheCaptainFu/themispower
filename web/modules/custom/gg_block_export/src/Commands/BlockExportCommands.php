<?php

namespace Drupal\gg_block_export\Commands;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\File\FileSystemInterface;
use Drush\Commands\DrushCommands;
use Symfony\Component\Yaml\Yaml;

/**
 * Drush commands for exporting and importing block content.
 */
class BlockExportCommands extends DrushCommands {

  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * The file system service.
   *
   * @var \Drupal\Core\File\FileSystemInterface
   */
  protected $fileSystem;

  /**
   * Constructor.
   */
  public function __construct(EntityTypeManagerInterface $entity_type_manager, FileSystemInterface $file_system) {
    parent::__construct();
    $this->entityTypeManager = $entity_type_manager;
    $this->fileSystem = $file_system;
  }

  /**
   * Export all block content to YAML files.
   *
   * @command gg_block_export:export
   * @aliases bex,block-export
   * @usage gg_block_export:export
   *   Export all custom blocks to content/blocks directory
   */
  public function export() {
    $this->output()->writeln('Starting block content export...');
    
    // Create export directory
    $export_dir = 'content/blocks';
    $this->fileSystem->prepareDirectory($export_dir, FileSystemInterface::CREATE_DIRECTORY);
    
    // Load all block content entities
    $block_content_storage = $this->entityTypeManager->getStorage('block_content');
    $blocks = $block_content_storage->loadMultiple();
    
    $exported_count = 0;
    
    foreach ($blocks as $block) {
      $data = $this->blockToArray($block);
      
      // Create filename from UUID
      $uuid = $block->uuid();
      $filename = $export_dir . '/' . $uuid . '.yml';
      
      // Write to YAML file
      file_put_contents($filename, Yaml::dump($data, 10, 2));
      
      $this->output()->writeln("Exported: {$block->label()} ({$uuid})");
      $exported_count++;
    }
    
    $this->output()->writeln("Successfully exported {$exported_count} blocks to {$export_dir}/");
    $this->logger()->success("Block export complete!");
  }

  /**
   * Import all block content from YAML files.
   *
   * @command gg_block_export:import
   * @aliases bim,block-import
   * @usage gg_block_export:import
   *   Import all custom blocks from content/blocks directory
   */
  public function import() {
    $this->output()->writeln('Starting block content import...');
    
    $import_dir = 'content/blocks';
    
    if (!is_dir($import_dir)) {
      $this->logger()->error("Import directory {$import_dir} does not exist!");
      return;
    }
    
    $files = glob($import_dir . '/*.yml');
    
    if (empty($files)) {
      $this->logger()->warning("No YAML files found in {$import_dir}");
      return;
    }
    
    $block_content_storage = $this->entityTypeManager->getStorage('block_content');
    $imported_count = 0;
    $updated_count = 0;
    
    foreach ($files as $file) {
      $data = Yaml::parseFile($file);
      
      // Check if block already exists by UUID
      $existing_blocks = $block_content_storage->loadByProperties(['uuid' => $data['uuid']]);
      
      if ($existing_blocks) {
        // Update existing block
        $block = reset($existing_blocks);
        $this->updateBlockFromArray($block, $data);
        $block->save();
        $this->output()->writeln("Updated: {$data['info']} ({$data['uuid']})");
        $updated_count++;
      } else {
        // Create new block
        $block = $this->arrayToBlock($data);
        $block->save();
        $this->output()->writeln("Created: {$data['info']} ({$data['uuid']})");
        $imported_count++;
      }
    }
    
    $this->output()->writeln("Import complete! Created: {$imported_count}, Updated: {$updated_count}");
    $this->logger()->success("Block import complete!");
  }

  /**
   * List all custom blocks.
   *
   * @command gg_block_export:list
   * @aliases blst,block-list
   * @usage gg_block_export:list
   *   List all custom blocks in the system
   */
  public function listBlocks() {
    $block_content_storage = $this->entityTypeManager->getStorage('block_content');
    $blocks = $block_content_storage->loadMultiple();
    
    if (empty($blocks)) {
      $this->output()->writeln('No custom blocks found.');
      return;
    }
    
    $this->output()->writeln('Custom Blocks:');
    $this->output()->writeln('');
    
    foreach ($blocks as $block) {
      $this->output()->writeln("ID: {$block->id()}");
      $this->output()->writeln("  Label: {$block->label()}");
      $this->output()->writeln("  Type: {$block->bundle()}");
      $this->output()->writeln("  UUID: {$block->uuid()}");
      $this->output()->writeln("  Status: " . ($block->isPublished() ? 'Published' : 'Unpublished'));
      $this->output()->writeln('');
    }
  }

  /**
   * Convert block entity to array.
   */
  protected function blockToArray($block) {
    $data = [
      'uuid' => $block->uuid(),
      'type' => $block->bundle(),
      'info' => $block->label(),
      'langcode' => $block->language()->getId(),
      'status' => $block->isPublished(),
      'reusable' => $block->isReusable(),
      'fields' => [],
    ];
    
    // Export all fields
    foreach ($block->getFields(FALSE) as $field_name => $field) {
      // Skip base fields we've already handled
      if (in_array($field_name, ['id', 'uuid', 'type', 'info', 'langcode', 'status', 'reusable', 'revision_id', 'revision_created', 'revision_user', 'revision_log', 'changed'])) {
        continue;
      }
      
      $data['fields'][$field_name] = $field->getValue();
    }
    
    return $data;
  }

  /**
   * Create block entity from array.
   */
  protected function arrayToBlock(array $data) {
    $block_data = [
      'uuid' => $data['uuid'],
      'type' => $data['type'],
      'info' => $data['info'],
      'langcode' => $data['langcode'] ?? 'el',
      'status' => $data['status'] ?? TRUE,
      'reusable' => $data['reusable'] ?? TRUE,
    ];
    
    // Add fields
    if (!empty($data['fields'])) {
      foreach ($data['fields'] as $field_name => $field_value) {
        $block_data[$field_name] = $field_value;
      }
    }
    
    $block_content_storage = $this->entityTypeManager->getStorage('block_content');
    return $block_content_storage->create($block_data);
  }

  /**
   * Update existing block from array.
   */
  protected function updateBlockFromArray($block, array $data) {
    $block->set('info', $data['info']);
    $block->set('status', $data['status'] ?? TRUE);
    $block->set('reusable', $data['reusable'] ?? TRUE);
    
    // Update fields
    if (!empty($data['fields'])) {
      foreach ($data['fields'] as $field_name => $field_value) {
        if ($block->hasField($field_name)) {
          $block->set($field_name, $field_value);
        }
      }
    }
  }

}

