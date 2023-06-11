<?php

namespace Drupal\yashaswi_exercise\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Implements controller.
 */
class CustomController extends ControllerBase {

  /**
   * A controller file.
   */
  public function exercise() {
    // Defined function name exercise.
    // Calling the service.
    $data = \Drupal::service('custom_service')->getName();
    return [
    // Using the templte we created here.
      '#theme' => 'controller_template',
    // Returning the data used in service.
      '#markup' => $data,
    // Providing value so that the username displays in red color.
      '#hexcode' => '#0000FF',
    ];
  }

}
