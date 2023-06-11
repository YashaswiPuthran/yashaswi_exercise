<?php

namespace Drupal\custom_drush\Commands;

use Consolidation\OutputFormatters\StructuredData\RowsOfFields;
use Drush\Commands\DrushCommands;
use Drupal\Core\Entity\EntityTypeManagerInterface;

/**
 * Implements drushcommands.
 */
class DrushTask extends DrushCommands {

  /**
   * Drupal entity manager.
   *
   * @var Drupal\Core\Entity\EntityTypeManagerInterface $entityManager
   *    Entity manager service.
   */
  public function __construct(EntityTypeManagerInterface $entityTypeManager) {
    $this->entityManager = $entityTypeManager;
    parent::__construct();
  }

  /**
   * Command that returns a list of all blocked users.
   *
   * @field-labels
   *  id: Node Id
   *  title: Title
   * @default-fields id,title
   *
   * @usage drush-helpers: title-id
   *   Returns all title-id
   *
   * @command drush-helpers:title-id
   * @aliases title-id
   * This is command.
   * This is demo.
   *
   * @return \Consolidation\OutputFormatters\StructuredData\RowsOfFields
   *   This will return the value.
   */
  public function drushDemo() {
    $nodes = \Drupal::entityTypeManager()->getStorage('node')->loadByProperties(['type' => 'page']);
    $rows = [];
    foreach ($nodes as $node) {
      $rows[] = [
        'id' => $node->id(),
        'title' => $node->getTitle(),
      ];
    }
    return new RowsOfFields($rows);
  }

}
