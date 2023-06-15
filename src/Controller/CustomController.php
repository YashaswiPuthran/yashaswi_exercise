<?php

namespace Drupal\yashaswi_exercise\Controller;

// Base class for controller.
use Drupal\Core\Controller\ControllerBase;
use Drupal\yashaswi_exercise\CustomService;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * To include custom_service.
 */
class CustomController extends ControllerBase {
  /**
   * The customservice.
   *
   * @var \Drupal\yashaswi_exercise\CustomService
   */
  protected $customService;

  /**
   * Dependency injection.
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('custom_service')
    );
  }

  /**
   * Constructor.
   */
  public function __construct(CustomService $customService) {
    $this->customService = $customService;
  }

  /**
   * Function demo.
   */
  public function exercise() {
    // Defining function.
    $data = $this->customService->getName();
    return [
    // Rendering the template.
      '#theme' => 'controller_template',
    // Value is passed.
      '#markup' => $data,
    // Color.
      '#hexcode' => '#0000FF',
    ];
  }

}
