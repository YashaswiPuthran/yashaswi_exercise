<?php


namespace Drupal\yashaswi_exercise\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormInterface;
use Drupal\custom_task\Form\CustomForm;

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

    $form = \Drupal::formBuilder()->getForm('Drupal\yashaswi_exercise\Form\CustomForm'); # rendered a custom form using the formbuilder() inside the block build function

    return $form;
   }
}