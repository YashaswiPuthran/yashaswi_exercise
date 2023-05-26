<?php

namespace Drupal\yashaswi_exercise;

use Drupal\Core\Config\ConfigFactory;

/**
 * Class CustomService.
 *
 * @package Drupal\yashaswi_exercise\Services
 */
class CustomService { #creating a service

  /**
   * Configuration Factory.
   *
   * @var \Drupal\Core\Config\ConfigFactory
   */
  protected $configFactory;

  /**
   * Constructor.
   */
  public function __construct(ConfigFactory $configFactory) { #this function gets called first
    $this->configFactory = $configFactory;
  }

  /**
   * Gets my setting.
   */
  public function getName() { # function that takes the value of username and returns it
    $config = $this->configFactory->get('yashaswi_exercise.settings');
    return $config->get('username');
  }

}