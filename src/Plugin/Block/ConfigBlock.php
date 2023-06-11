<?php

namespace Drupal\yashaswi_exercise\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides simple block for d4drupal.
 *
 * @Block (
 * id = "yashaswi_exercise",
 * admin_label = "Config Block"
 * )
 */
class ConfigBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    // Render function.
    $form = \Drupal::formBuilder()->getForm('\Drupal\yashaswi_exercise\Form\CustomConfigForm');
    return $form;

  }

}
