<?php

namespace Drupal\custom_form\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * This is a modal controller.
 */
class ModalController extends ControllerBase {

  /**
   * This is a form.
   */
  public function modalForm() {
    $build['#attached']['library'][] = 'core/drupal.dialog.ajax';
    $build = [
      '#markup' => '<a href="/drupal-10.0.3/get-user-details" class="use-ajax" data-dialog-type="modal">Click here</a>',
    ];
    return $build;
  }

}
