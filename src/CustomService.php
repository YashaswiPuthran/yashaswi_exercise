<?php

namespace Drupal\yashaswi_exercise;

use Drupal\Core\Config\ConfigFactory;

/**
 * This is for custom service.
 *
 * @package Drupal\yashaswi_exercise\Services
 */
class CustomService {
  // Creating a service.

  /**
   * Configuration Factory.
   *
   * @var \Drupal\Core\Config\ConfigFactory
   */
  protected $configFactory;

  /**
   * Constructor.
   */
  public function __construct(ConfigFactory $configFactory) {
    // This function gets called first.
    $this->configFactory = $configFactory;
  }

  /**
   * Gets my setting.
   */
  public function getName() {
    // Function that takes the value of username and returns it.
    $config = $this->configFactory->get('yashaswi_exercise.settings');
    return $config->get('username');
  }

}
