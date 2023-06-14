<?php

namespace Drupal\yashaswi_exercise\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormBuilderInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a 'Custom' block.
 *
 * @Block(
 *   id = "custom_task",
 *   admin_label = "Yashaswi block",
 * )
 */
// class CustomBlock extends BlockBase {

//   /**
//    * {@inheritdoc}
//    */
//   public function build() {

//     // Rendered a custom form inside the block build function.
//     $form = \Drupal::formBuilder()->getForm('Drupal\yashaswi_exercise\Form\CustomForm');

//     return $form;
//   }

// }

/**
 * Provides a custom block form.
 *
 * @Block(
 *   id = "custom_block_form",
 *   admin_label = @Translation("Custom Block Form"),
 * )
 */
class CustomBlock extends BlockBase implements ContainerFactoryPluginInterface
{

  /**
   * The form builder.
   *
   * @var \Drupal\Core\Form\FormBuilderInterface
   */
  protected $formBuilder;

  /**
   * Constructs a new CustomBlockFormBlock instance.
   *
   * @param array $configuration
   *   The block configuration.
   * @param string $plugin_id
   *   The plugin ID for the block.
   * @param mixed $plugin_definition
   *   The plugin definition for the block.
   * @param \Drupal\Core\Form\FormBuilderInterface $form_builder
   *   The form builder.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, FormBuilderInterface $form_builder)
  {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->formBuilder = $form_builder;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition)
  {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('form_builder')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build()
  {
    $form = \Drupal::formBuilder()->getForm('Drupal\yashaswi_exercise\Form\CustomForm');

    $rendered_form = \Drupal::service('renderer')->render($form);
    return [
      '#markup' => $rendered_form,
    ];
  }

}