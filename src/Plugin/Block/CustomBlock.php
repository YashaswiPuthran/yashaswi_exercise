<?php

namespace Drupal\yashaswi_exercise\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Custom' block.
 *
 * @Block(
 *   id = "custom_task",
 *   admin_label = "Yashaswi block", # providing label to the block
 * )
 */
class CustomBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {

    // Rendered a custom form inside the block build function.
    $form = \Drupal::formBuilder()->getForm('Drupal\yashaswi_exercise\Form\CustomForm');

    return $form;
  }

}
